require('../bootstrap');

window.Vue = require('vue');
var role = new Vue({
    el: "#role",
    data: {
        roleAndPer: roleAndPer,
        newRole: null,
        roles : {},
        role: null,
        permissionElm: "#permission",
        permissions: {},
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
                     _this.setMessage(response.data)
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
                _this.setMessage(response.data);
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
});
