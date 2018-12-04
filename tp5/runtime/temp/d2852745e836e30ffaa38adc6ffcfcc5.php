<?php /*a:1:{s:62:"D:\www\myecshop\tp5\application\admin\view\goods\showList.html";i:1543376705;}*/ ?>
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
    .good-search{
            margin-right: 5px;
        }
    </style>
</head>

<body>
  <section class="content-header">
    <h1>
      商品列表
    </h1>
   
    <ol class="breadcrumb ">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
    <button class="btn btn-primary btn-success action-btn">添加新商品</button>
  </section>

  <section class="content">
    <div id="toolbar" class="clearfix" style="margin-bottom:5px;">
      <div class="pull-left good-search" style="padding-top:5px;">

        <i class="iconfont icon-sousuo"></i>
      </div>
      <div class="pull-left good-search">
        <select class="form-control " name="account">
          <option value="0">所有分类</option>
          <!-- 输出商品分类 -->
          <!-- very important -->
          <?php if(is_array($list_cats) || $list_cats instanceof \think\Collection || $list_cats instanceof \think\Paginator): if( count($list_cats)==0 ) : echo "" ;else: foreach($list_cats as $key=>$one): ?>
              <option value=<?php echo htmlentities($one['cat_id']); ?>><?php echo htmlentities($one['cat_name']); ?></option>
              <?php if(is_array($one['child']) || $one['child'] instanceof \think\Collection || $one['child'] instanceof \think\Paginator): if( count($one['child'])==0 ) : echo "" ;else: foreach($one['child'] as $key=>$two): ?>
                  <option value=<?php echo htmlentities($two['cat_id']); ?>>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($two['cat_name']); ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
          <?php endforeach; endif; else: echo "" ;endif; ?>


        </select>
      </div>
      <div class="pull-left good-search">
        <select class="form-control " name="account">
          <option value="0">品牌</option>
          <?php if(is_array($list_brands) || $list_brands instanceof \think\Collection || $list_brands instanceof \think\Paginator): $i = 0; $__LIST__ = $list_brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value=<?php echo htmlentities($vo['brand_id']); ?>><?php echo htmlentities($vo['brand_name']); ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
      <div class="pull-left good-search">
        <select class="form-control" name="intro_type">
          <option value="0">全部</option>
          <option value="is_best">精品</option>
          <option value="is_new">新品</option>
          <option value="is_hot">热销</option>
          <option value="is_promote">特价</option>
          <option value="all_type">全部推荐</option>
        </select>

      </div>
      <div class="pull-left good-search">
        <select class="form-control" name="suppliers_id">
          <option value="0">全部</option>
          <option value="1">北京供货商</option>
          <option value="2">上海供货商</option>
        </select>
      </div>
      <div class="pull-left good-search">
        <select class="form-control" name="is_on_sale">
          <option value="">全部</option>
          <option value="1">上架</option>
          <option value="0">下架</option>
        </select>

      </div>
      <div class="pull-left good-search">
        <label for="">关键字</label>
        <input type="text" class="form-control" style="width:120px;display:inline-block">
        <button id="goods-search" class="btn btn-small btn-primary">搜索</button>
      </div>

    </div>


    <table id="goods-list">

    </table>

  </section>

  <!-- Mainly scripts -->
  <script src="/static/admin/js/jquery-3.1.1.min.js"></script>
  <script src="/static/admin/js/bootstrap.min.js"></script>
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
      // console.log('value:' + value + ';row:' + row + 'index:' + index);
      // 如果存在附件
      if (value == 1) {
        return [
          '<button  class="btn btn-info btn-sm rightSize detailBtn" type="button" style="margin-left:5px;margin-right:8px;"><i class="fa fa-paste"></i>&nbsp;查看</button>',
          '<button class="btn btn-danger btn-sm rightSize downBtn" type="button"><i class="fa fa-envelope"></i>&nbsp;下载</button>'
        ].join("");
      } else {
        return '<button  class="btn btn-info btn-sm rightSize detailBtn" type="button" style="margin-left:5px;"><i class="fa fa-paste"></i>&nbsp;查看</button>';
      }


    };
    var formateGoodsStatus = function (value, row, index) {
      if (value == 1) {
        return '<i class="iconfont icon-duigou text-green" ></i>';
      }
      else {
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


    var columns = [{
      checkbox: true
    },
    {
      field: "goods_id",
      title: "编号",
      align: "center",
      width: 100,
      /*colspan: 2*/
      sortable: true,
      sortName: "goods_id",
      order: "desc"
    },
    {
      field: "goods_name",
      title: "商品名称",
      align: "center",
      sortable: false //本列不可以排序
    },
    {
      field: "goods_sn",
      title: "货号",
      align: "center",
      sortable: false //本列不可以排序
    },
    {
      field: "market_price",
      title: "价格",
      align: "center"
    },
    {
      field: "is_on_sale",
      title: "上架",
      align: "center",
      clickToSelect: false,
      formatter: formateGoodsStatus
    },
    {
      field: "is_best",
      title: "精品",
      align: "center",
      halign: "center", //设置表头列居中对齐

      formatter: formateGoodsStatus
    },
    {
      field: "is_new",
      title: "新品",
      align: "center",
      formatter: formateGoodsStatus
    },
    {
      field: "is_hot",
      title: "热销",
      align: "center",
      formatter: formateGoodsStatus
    },

    {
      field: "goods_number",
      title: "库存",
      align: "center",

    },
    {
      field: "operate",
      title: "操作",
      align: "left",
      formatter: operateFormatter //自定义方法，添加操作按钮
    }

    ];

    console.log('body.clientHeight' + document.body.clientHeight);
    // 商品列表
    $("#goods-list")
      .bootstrapTable("destroy")
      .bootstrapTable({
        url: "/index.php/admin/goods/getGoodsList", //url一般是请求后台的url地址,调用ajax获取数据。此处我用本地的json数据来填充表格。
        method: "get", //使用get请求到服务器获取数据
        dataType: "json",
        contentType: "application/json,charset=utf-8",
        // toolbar: "#toolbar", //一个jQuery 选择器，指明自定义的toolbar 例如:#toolbar, .toolbar.
        uniqueId: "goods_id", //每一行的唯一标识，一般为主键列
        // height: document.body.clientHeight - 320, //动态获取高度值，可以使表格自适应页面
        height: 580,
        cache: false, // 不缓存
        striped: true, //是否显示行间隔色
        queryParamsType: "limit", //设置为"undefined",可以获取pageNumber，pageSize，searchText，sortName，sortOrder

        sidePagination: "server", //分页方式：client客户端分页，server服务端分页（*）
        sortable: true, //是否启用排序;意味着整个表格都会排序
        sortName: "goods_id", // 设置默认排序为 name
        sortOrder: "desc", //排序方式
        pagination: true, //是否显示分页（*）
        // search: true, //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
        // strictSearch: true,
        // showColumns: true, //是否显示所有的列
        // showRefresh: true, //是否显示刷新按钮
        // showToggle: true, //是否显示详细视图和列表视图
        clickToSelect: true, //是否启用点击选中行
        minimumCountColumns: 2, //最少允许的列数 clickToSelect: true, //是否启用点击选中行
        pageNumber: 1, //初始化加载第一页，默认第一页
        pageSize: 10, //每页的记录行数（*）
        pageList: [10, 25, 50, 100], //可供选择的每页的行数（*）
        paginationPreText: "上一页",
        paginationNextText: "下一页",
        paginationFirstText: "第一页",
        paginationLastText: "末页",
        responseHandler: responseHandler,
        columns: columns,
        rowStyle: rowStyle,
        onLoadSuccess: function (data) {
          //加载成功时执行
          console.log('加载成功:');
          console.log(data);
        },
        onLoadError: function (res) {
          //加载失败时执行
          console.log('加载失败:');
          // console.log(res);
        },
        // 表格渲染完成后触发
        onPostBody: function () {

        }

      });

    $('#goods-search').on('click', function () {
      console.log('search btn is clicked');
      // var params = { url: "index.php/admin/goods/getGoodsListBySearch" };
      var myObject = {
        url: "/index.php/admin/goods/getGoodsListBySearch"

      };
      $("#goods-list").bootstrapTable('refresh', myObject);

    });

  </script>

</body>

</html>