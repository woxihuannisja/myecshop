<?php /*a:1:{s:76:"D:\www\myecshop\tp5\application\admin\view\goods_category\show_category.html";i:1543496471;}*/ ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>ecshop</title>

  <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="/static/admin/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">

  <link rel="stylesheet" href="/static/admin/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/static/admin/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/static/admin/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="/static/admin/css/mystyle.css">
  <link href="/static/common/iconfont/iconfont.css" rel="stylesheet">

  <link rel="stylesheet" href="/static/admin/plugins/bootstrap-table/bootstrap-table.min.css" />
  <style>
    .good-search {
      margin-right: 5px;
    }
  </style>
</head>

<body>
  <section class="content-header">
    <h1>
      商品分类
    </h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>

    <button class="btn btn-primary btn-success action-btn" id="add_category"> 添加商品分类</button>
  </section>

  <section class="content">
    <table id="goodsCategory-list">

    </table>

  </section>

  <!-- Mainly scripts -->
  <script src="/static/admin/js/jquery-3.1.1.min.js"></script>
  <script src="/static/admin/js/bootstrap.min.js"></script>
  <link href="/static/admin/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">

  <!-- <script src="/static/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script> -->
  <script src="/static/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

  <!-- Custom and plugin javascript -->
  <!-- <script src="/static/admin/js/inspinia.js"></script> -->
  <!-- AdminLTE App -->
  <script src="/static/admin/js/adminlte.min.js"></script>
  <script src="/static/admin/js/plugins/pace/pace.min.js"></script>
  <script src="/static/admin/plugins/bootstrap-table/bootstrap-table.min.js"></script>

  <script>
    var operateFormatter = function (value, row, index) {

      var html =
        '<button  class="btn btn-info btn-sm rightSize detailBtn" type="button" style="margin-left:5px;margin-right:8px;"><i class="fa fa-paste"></i>&nbsp;编辑</button>';
      html +=
        '<button  class="btn btn-danger btn-sm rightSize delBtn" type="button" style="margin-left:5px;margin-right:8px;"><i class="fa fa-paste"></i>&nbsp;移除分类</button>'
      return html;
    };

    var catNameFormat = function (value, row, index) {
      // console.log(row);
      var level = row.level;
      // 第一层分类和第二层分类
      var icon_id='icon_'+level+'_'+row.cat_id;
      if (level == 0 || level == 1) {
        value =
          '<span class="glyphicon glyphicon-plus btn-warning" style="padding:2px; font-size:12px;" id="'+icon_id+'" onclick="rowClicked(this)"></span>' +
          value;
        // value = '<i class="iconfont icon-plus" style="color:#f0ad4e;"></i>' + value;
      }
      if (level != 0) {
        value = "&nbsp;&nbsp;&nbsp;".repeat(level) + value;
      }
      return value;

    };

    var formateStatus = function (value, row, index) {

      if (value == 1) {
        return '<i class="iconfont icon-duigou text-green" ></i>';
      } else {
        return '<i class="iconfont icon-chacha text-danger"></i>';
      }
    }
    var responseHandler = function (e) {
      if (e.data && e.data.length > 0) {
        return {
          rows: e.data,
          total: e.count
        };
      } else {
        return {
          rows: [],
          total: 0
        };
      }
    };

    var rowStyle = function (row, index) {
      var classesArr = ["success", "info"];

      if (index % 2 === 0) {
        //偶数行
        return {
          classes: classesArr[0]

        };
      } else {
        //奇数行
        return {
          classes: classesArr[1]

        };
      }
    };

    // 重制表格的高度
    function resetTableHeight()
    {
      var tbl = document.getElementById("goodsCategory-list");
      var count=0;
      // console.log('表格的行数:'+tbl.rows.length);
      // 从1开始 去掉表头的循环
      for (i = 1; i < tbl.rows.length; i++){
        var row = tbl.rows[i];
        if($(row).css('display')!='none'){
          count++;
        }
      }
      console.log('重制表格的高度,显示的行数目:'+count);
      $('#goodsCategory-list').bootstrapTable('resetView', {height:count*config.heightUnit+90});
    }

    var columns = [{
        field: "cat_id",
        title: "分类id",
        align: "center",
        width: 100,
        /*colspan: 2*/
        sortable: false,

      },
      {
        field: "cat_name",
        title: "分类名称",
        align: "left",
        sortable: false, //本列不可以排序\
        formatter: catNameFormat
      },
      {
        field: "show_in_nav",
        title: "是否推荐", //导航栏推荐
        align: "center",
        sortable: false,
        formatter: formateStatus
      },

      {
        field: "is_show",
        title: "显示",
        align: "center",
        sortable: false,
        formatter: formateStatus
      },

      {
        field: "operate",
        title: "操作",
        align: "left",
        formatter: operateFormatter //自定义方法，添加操作按钮
      }

    ];


    var config = {
      uniqueId: 'cat_id',
      pageSize: 4,
      url: "/index.php/admin/goodsCategory/getCategoryList",
      heightUnit:50 //表格行的高度
    };
    var tableHeight=config.pageSize*config.heightUnit+90;
    
    
    $("#goodsCategory-list")
      .bootstrapTable("destroy")
      .bootstrapTable({
        url: config.url,
        method: "get", //使用get请求到服务器获取数据
        dataType: "json",
        contentType: "application/json,charset=utf-8",
        // toolbar: "#toolbar", //一个jQuery 选择器，指明自定义的toolbar 例如:#toolbar, .toolbar.
        uniqueId: config.uniqueId, //类型id
        // height: document.body.clientHeight - 320, //动态获取高度值，可以使表格自适应页面
        height: tableHeight,
        cache: false,
        striped: true,
        queryParamsType: "limit", //设置为"undefined",可以获取pageNumber，pageSize，searchText，sortName，sortOrder

        sidePagination: "server", //分页方式：client客户端分页，server服务端分页（*）
        sortable: true, //是否启用排序;意味着整个表格都会排序
        // sortName: "goods_id", // 设置默认排序为 name
        // sortOrder: "desc", //排序方式
        pagination: true, //是否显示分页（*）
      
        clickToSelect: true, //是否启用点击选中行
        minimumCountColumns: 2, //最少允许的列数 clickToSelect: true, //是否启用点击选中行
        pageNumber: 1, //初始化加载第一页，默认第一页
        pageSize: config.pageSize, //每页的记录行数（*）
        pageList: [10, 25, 50, 100], //可供选择的每页的行数（*）
        paginationPreText: "上一页",
        paginationNextText: "下一页",
        paginationFirstText: "第一页",
        paginationLastText: "末页",
        responseHandler: responseHandler,
        columns: columns,
        rowStyle: rowStyle,

        rowAttributes: function (row, index) {
          // console.log('rowAttribute:');
          // console.log(row);
          var a;
          // 默认只显示第一层分类
          if (row.level == 0) {
            a = "table-row";
          } else {
            a = "none";
          }
          return {
            'data-level': row.level,
            'style': 'display:' + a

          }
        },

        // 表格渲染完成后触发
        onPostBody: function () {
          console.log('表格渲染完成');
          // 重制表格的高度
          var table = '#goodsCategory-list';
          resetTableHeight();
          // 表格的每个查看按钮
          var detailBtn = $(table + ' tr .detailBtn');
          console.log(detailBtn);
        }


      });

    $('#add_category').click(function () {
      console.log('点击添加分类按钮');
      window.location.href = "/index.php/admin/goodsCategory/addCategory.html";
    })

    // obj代表点击的对象
    function rowClicked(obj) {
      console.log('row Clicked');
      span = obj;
      // 获取点击的当前行
      obj = obj.parentNode.parentNode;
      var tbl = document.getElementById("goodsCategory-list");
      // var lvl = parseInt(obj.className);
      var level = parseInt($(obj).attr('data-level'));
      console.log('current row level:' + level);
      var fnd = false;
      var sub_display = $(span).hasClass('glyphicon-minus') ? 'none' : '' ? 'block' : 'table-row';
      console.log('sub_display:'+sub_display);
      if (sub_display == 'none') {
        $(span).removeClass('glyphicon-minus btn-info');
        $(span).addClass('glyphicon-plus btn-warning');
      } else {
        $(span).removeClass('glyphicon-plus btn-info');
        $(span).addClass('glyphicon-minus btn-warning');
      }
      // 显示或隐藏的行数
      var count=0;
      for (i = 0; i < tbl.rows.length; i++) {
        var row = tbl.rows[i];

        if (row == obj) {
          fnd = true;
        } else {
          if (fnd == true) {
            // 获取当前的level
            var cur=$(row).attr('data-level');
            var dataId=$(row).attr('data-uniqueid');
            var icon = 'icon_' + cur+'_'+dataId;
            if (cur > level) {
              row.style.display = sub_display;
              sub_display=='none'?count--:count++;
              if (sub_display != 'none')
                  {
                      var iconimg = document.getElementById(icon);
                      $(iconimg).removeClass('glyphicon-plus btn-info');
                      $(iconimg).addClass('glyphicon-minus btn-warning');
                  }else{               	    
                      $(iconimg).removeClass('glyphicon-minus btn-info');
                      $(iconimg).addClass('glyphicon-plus btn-warning');
                  }
            } else {
              fnd = false;
              break;
            }
          }
        }
      }
      

      //重制表的高度
      // tableHeight=tableHeight+count*50;
      // $('#goodsCategory-list').bootstrapTable('resetView', {height:tableHeight});
      resetTableHeight();
    }
  </script>

</body>

</html>