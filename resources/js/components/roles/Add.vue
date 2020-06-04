<template>
    <div>
        <div class="row" id="role">
            <div class="col">
                <div class="card border-0 shadow">
                    <div class="card-header border-0">
                        <h3>Add Role</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-inline">
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Role input..." v-model="newRole" v-on:keypress.enter="addRole">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" v-on:click="addRole">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h5 class="text-primary">Danh sach Roles</h5>
                                <div class="list-group list-role">
                                    <button type="button" class="btn list-group-item list-group-item-action" v-for="(role, i) in roles" v-on:click="setPermission" v-bind:data_role="role.name" v-bind:id="'role_'+i">
                                        {{ role.name }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-8">
                                <div style="display: none" id="permission">
                                    <h5>Chọn quyền</h5>
                                    <div class="form-group" v-for="(item, k) in roleAndPer">
                                        <div v-for="(listPermission, i) in item" >
                                            <b>{{ i }}: </b>
                                            <label class="" v-for="(per, j) in listPermission">
                                                <input type="checkbox" class="d-inline" v-on:click="assignPermissionForRole()" v-model="roleAndPer[k][i][j]">
                                                {{ per }}
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                roleAndPer: roleAndPer,
                newRole: null,
                roles : {},
                role: null,
                permissionElm: "#permission",
                permissions: {},
            }
        },
        methods: {
            /**
             * thêm một role mới
             */
            addRole: function () {
                let _this = this;
                let url = addRoleUrl;
                let data = {role: _this.newRole};
                axios.post(url, data)
                    .then(function (response) {
                        //_this.setMessage(response.data)
                        _this.newRole = null;
                        _this.getRoles();
                    })
            },
            /**
             * Hiển thị tin nhắn khi sửa, thêm dữ liệu
             * @param response
             */
            setMessage: function (response) {
                let _this = this;
                if (response.status) {
                    $.notify(response.message, "success");
                } else {
                    $.notify(response.message, "error");
                }

            },

            /**
             * Lấy các Role từ DB ra
             */
            getRoles: function () {
                let _this = this;
                let url = getRoleUrl;
                axios.get(url)
                    .then(function (response) {
                        _this.roles = response.data.data;
                    });
            },

            /**
             * Gán permission cho 1 role
             * @param event
             */
            setPermission: function (event) {
                let _this = this;
                _this.role = event.target.attributes.data_role.value;
                let idElm = "#" + event.target.attributes.id.value;
                $(".list-role button").each(function () {
                    $(this).removeClass("active");
                });
                $(idElm).addClass("active");
                $(_this.permissionElm).css({"display": "block"});
                _this.getPermissionByRole();
            },

            /**
             * Lấy permission theo role được click vào
             */
            getPermissionByRole: function() {
                var _this = this;
                let url = getPermissionByRoleUrl + "?role=" + _this.role;
                axios.get(url)
                    .then(function (response) {
                        _this.checkPermissionSelect(response.data.data);
                    });
            },

            /**
             * gán quyền hoặc bỏ quyền của 1 role
             * @param permission
             * @param check
             */
            assignPermissionForRole: function (permission, check) {
                let _this = this;
                let url = assignPermissionUrl;
                let assign = (check == 1) ? false : true;
                let data = {role: _this.role, permission: permission, is_assign: assign};
                axios.post(url, data).then(function (response) {
                    //_this.setMessage(response.data);
                });
            },

            /**
             * Kiểm tra permission
             * @param permission
             */
            checkPermissionSelect: function (permission) {
                let _this = this;
                for (let j in _this.roleAndPer) {
                    for (let k in _this.roleAndPer[j].permission) {
                        let perName = _this.roleAndPer[j].permission[k].name + " " + _this.roleAndPer[j].role;
                        _this.roleAndPer[j].permission[k].check = 0;
                        for (let i in permission) {
                            permission.find(function(item, i) {
                                if (item.name == perName) {
                                    _this.roleAndPer[j].permission[k].check = 1;
                                }
                            });
                        }
                    }
                }
            }
        },

        created: function () {
            this.getRoles();
        }
    }
</script>