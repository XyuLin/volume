define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'problem/index' + location.search,
                    add_url: 'problem/add',
                    edit_url: 'problem/edit',
                    del_url: 'problem/del',
                    multi_url: 'problem/multi',
                    table: 'problem',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'weigh',
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'title', title: __('Title'),operate:false},
                        // {field: 'switch', title: __('Switch'), formatter: Table.api.formatter.toggle},
                        // {field: 'weigh', title: __('Weigh')},
                        {field: 'a', title: __('A'),visible:false,operate:false},
                        {field: 'b', title: __('B'),visible:false,operate:false},
                        {field: 'c', title: __('C'),visible:false,operate:false},
                        {field: 'd', title: __('D'),visible:false,operate:false},
                        {field: 'e', title: __('E'),visible:false,operate:false},
                        {field: 'f', title: __('F'),visible:false,operate:false},
                        {field: 'h', title: __('H'),visible:false,operate:false},
                        {field: 'g', title: __('G'),visible:false,operate:false},
                        {field: 'i', title: __('I'),visible:false,operate:false},
                        {field: 'a_name', title: __('A'),operate:false},
                        {field: 'b_name', title: __('B'),operate:false},
                        {field: 'c_name', title: __('C'),operate:false},
                        {field: 'd_name', title: __('D'),operate:false},
                        {field: 'e_name', title: __('E'),operate:false},
                        {field: 'f_button', title: __('F'),operate:false,table: table,
                            events: Table.api.events.operate,buttons:[
                                {
                                    name: 'addtabs',
                                    text: __('查看其他评价'),
                                    title: '查看其他评价',
                                    classname: 'btn btn-xs btn-warning btn-addtabs',
                                    icon: 'fa fa-list',
                                    url: 'paper/index?',
                                    visible:function(row) {
                                        console.log(row.F);
                                        if(row.F == 0) {
                                            return false;
                                        } else {
                                            return true;
                                        }
                                    }
                                }
                            ],formatter: Table.api.formatter.buttons
                        },
                        {field: 'g_name', title: __('G'),operate:false},
                        {field: 'h_name', title: __('H'),operate:false},
                        {field: 'i_name', title: __('I'),operate:false},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate')
                            // ,buttons:[
                            //     {
                            //         name: 'addtabs',
                            //         text: __('问题选项'),
                            //         title: '问题选项',
                            //         classname: 'btn btn-xs btn-warning btn-addtabs',
                            //         icon: 'fa fa-list',
                            //         url: 'options/index?'
                            //     }
                            // ]
                            , table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            formatter: {//渲染的方法
                url: function (value, row, index) {
                    return '<div class="input-group input-group-sm" style="width:250px;"><input type="text" class="form-control input-sm" value="' + value + '"><span class="input-group-btn input-group-sm"><a href="' + value + '" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-link"></i></a></span></div>';
                },
                ip: function (value, row, index) {
                    return '<a class="btn btn-xs btn-ip bg-success"><i class="fa fa-map-marker"></i> ' + value + '</a>';
                },
                browser: function (value, row, index) {
                    //这里我们直接使用row的数据
                    return '<a class="btn btn-xs btn-browser">' + '查看其他评价' + '</a>';
                    // return 'nihoa';
                },
                browserTwo: function (value, row, index) {
                    //这里我们直接使用row的数据
                    return '<a class="btn btn-xs btn-browser">' + '查看学员评价' + '</a>';
                    // return 'nihoa';
                },
                custom: function (value, row, index) {
                    //添加上btn-change可以自定义请求的URL进行数据处理
                    return '<a class="btn-change text-success" data-url="example/bootstraptable/change" data-id="' + row.id + '"><i class="fa ' + (row.title == '' ? 'fa-toggle-off' : 'fa-toggle-on') + ' fa-2x"></i></a>';
                },
            },
            events: {//绑定事件的方法
                ip: {
                    //格式为：方法名+空格+DOM元素
                    'click .btn-ip': function (e, value, row, index) {
                        e.stopPropagation();
                        console.log();
                        var container = $("#table").data("bootstrap.table").$container;
                        var options = $("#table").bootstrapTable('getOptions');
                        //这里我们手动将数据填充到表单然后提交
                        $("form.form-commonsearch [name='ip']", container).val(value);
                        $("form.form-commonsearch", container).trigger('submit');
                        Toastr.info("执行了自定义搜索操作");
                    }
                },
                f_name: {
                    'click .btn-browser': function (e, value, row, index) {
                        e.stopPropagation();
                        Layer.alert("导师评价: <code>" + JSON.stringify(row.teacher_evaluate) + "</code>");
                    }
                },
                student_evaluate: {
                    'click .btn-browser': function (e, value, row, index) {
                        e.stopPropagation();
                        Layer.alert("学员评价: <code>" + JSON.stringify(row.student_evaluate) + "</code>");
                    }
                },
            }
        }
    };
    return Controller;
});