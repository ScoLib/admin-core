var vm = new Vue({
    el: '.wrapper',
    data: {
        info: {},
        show: false
    },
    methods: {
        createMenu: function () {
            alert('sss');
        },
        editMenu: function (event) {
            layer.load(2);
            $.getJSON($(event.target).data('url'), function (result) {
                layer.closeAll();
                if (result.state) {
                    vm.info = result.data;
                    layer.open({
                        title: '修改状态',
                        type: 1,
                        shadeClose: true,
                        area: '450px',
                        content: $('#menu-add').html(),
                        btn: ['确定', '取消'],
                        yes: function (index, layero) {
                            console.log(index);
                        }, cancel: function (index) {
                            layer.close(index);
                        }
                    });
                } else {
                    layer.msg(result.message, {'icon': 2, time : 2500, offset : 0});
                }

            })
        }
    }
});
