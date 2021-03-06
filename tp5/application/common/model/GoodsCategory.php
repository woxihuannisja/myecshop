<?php
namespace app\common\model;

use think\Model;
use think\Db;

class GoodsCategory extends Model
{
    // 设置表名
    // protected $table = 'db_goods_category';

    protected $pk = 'id';
  /**
     * 获取所有数据
     *
     * @return mixed
     */
    public function getList()
    {

        $parentField = "$this->pk id,cat_name,parent_id";

        $parent = $this->field( $parentField )
            ->where( 'shoutui=1  and is_show_nav=0' )
            ->order( 'sort_num desc' )
            ->select();

        return $parent;
    }

    /**
     * 获取导航标题
     *
     * @param int $classId
     *            商品分类编号
     * @param string $tag
     *            标题标签
     * @return string
     */
    public function getTitleByClassId( $classId,$tag )
    {
        static $number = 0;
        if( !is_numeric( $classId ) || $classId == 0 || $number > 3 ){
            return null;
        }

        $number++;

        $titleData = $this->field("$this->pk,cat_name,parent_id")
        ->where($this->pk,$classId )
        ->find();
        
            

        if( empty( $titleData ) ){
            return null;
        }

        if( $titleData[ 'parent_id'] == 0 ){
            $jump_url = url( "Product/ProductList",[
                "cid" => $classId
            ] );
            return '<' . $tag . '>' . '<a class="godos_details_font" href="' . $jump_url . '">' . $titleData['cat_name'] . '</a>' . '</' . $tag . '>';
        }
        $jump_url1 = url( "Product/ProductList",[
            "cid" => $classId
        ] );
        return '<' . $tag . '>' . $this->getTitleByClassId( $titleData['parent_id'],$tag ) . '</' . $tag . '>' . ' > ' . '<' . $tag . '>' . '<a href="' . $jump_url1 . '" class="godos_details_font">' . $titleData['cat_name'] . '</a>' . '</' . $tag . '>';
    }
}