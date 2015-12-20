<?php
namespace Home\Controller;


class DimensionController extends BaseController
{

    public function dimensionList()
    {
        $type = I('type');
        $dimension = M('Dimension');
        $dimensionList =  $dimension->select();
        
        $this->assign('dimensionList',$dimensionList);
        $this->display();
        
    }
    
    

}