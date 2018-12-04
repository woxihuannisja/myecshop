<?php /*a:1:{s:62:"D:\www\myecshop\tp5\application\admin\view\goods_spec\add.html";i:1543675280;}*/ ?>
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
  <section class="content">
    <!-- Main content -->
    <div class="container-fluid">
      <div class="pull-right">

        <a href="" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>

      </div>

      <div class="panel panel-default">

        <div class="panel-heading">

          <h3 class="panel-title">
            <i class="fa fa-list"></i> 商品规格详情
          </h3>

        </div>

        <div class="panel-body">
          <!--表单数据-->
          <form method="post" action="<?php echo url('goodsSpec/addOk'); ?>">
            <!--通用信息-->
            <div class="tab-content">

              <div class="tab-pane active" id="tab_tongyong">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td>商品规格名称:</td>
                      <td><input type="text" value="" name="name" class="form-control" style="width: 400px;" /></td>
                    </tr>
                    <tr>
                      <td>所属商品类型:</td>

                      <td><select class="form-control" name="type_id" style="width: 400px;">

                          <option value="">请选择</option>
                          <?php foreach($type as $vo): ?>
                            <option value="<?php echo htmlentities($vo['type_id']); ?>"><?php echo htmlentities($vo['type_name']); ?></option>
                          <?php endforeach; ?>


                        </select></td>

                    </tr>

                    <tr>

                      <td>商品规格项:<br /> (注意：1行为1个规格项)
                      </td>
                      <td><textarea rows="6" cols="80" name="items"></textarea>
                      </td>



                    </tr>

                    <tr>

                      <td>排序</td>

                      <td><input type="text" value="<?php echo htmlentities((isset($row['sort']) && ($row['sort'] !== '')?$row['sort']:20)); ?>" name="sort" class="form-control" style="width: 400px;" /></td>

                    </tr>

                    <tr>

                      <td>是否显示</td>

                      <td><label class="radio-inline"> <input type="radio" name="is_show" class="status" id="inlineRadio1"
                            value="1"> 是

                        </label> <label class="radio-inline"> <input type="radio" name="is_show" class="status" id="inlineRadio2"
                            value="0">
                          否

                        </label></td>

                    </tr>

                    <input type="hidden" name="id" value="" />



                  </tbody>

                </table>

              </div>

            </div>

            <div class="pull-right">
              <input type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="保存" value='保存'>

            </div>

          </form>
          <!--表单数据-->

        </div>

      </div>

    </div>
    <!-- /.content -->

  </section>
</body>

<!-- Mainly scripts -->
<script src="/static/admin/js/jquery-3.1.1.min.js"></script>
<script src="/static/admin/js/bootstrap.min.js"></script>
</html>
