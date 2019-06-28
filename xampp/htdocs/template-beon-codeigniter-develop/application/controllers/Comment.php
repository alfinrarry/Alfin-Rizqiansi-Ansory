<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends PIS_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_product','product');
        $this->load->model('Mod_comment','comment');
    }
    public function addComment(){
        $product = $this->product->getProductbyId($_POST['product'])->row_array();
        if(isset($_POST['submit'])){
            if (isset($_POST['parent']) != null) {
                $get_sender=$this->comment->getCommentById($_POST['parent']);
                $data = array(
                'id_product'=> $_POST['product'],
                'content'   => $_POST['content'],
                'id_user'   => $_SESSION['id'],
                'created_at'=> date('Y-m-d H:m:s'),
                'parent'    => $_POST['parent']
                );
            }else{
                $data = array(
                'id_product'=> $_POST['product'],
                'content'   => $_POST['content'],
                'id_user'   => $_SESSION['id'],
                'created_at'=> date('Y-m-d H:m:s'),
                'parent'    => 0
                );
            }
            $id_comment = $this->comment->addComment($data);
        //send notification
        
        if ($_SESSION['status']=="admin") {
            $id_user        = $get_sender['id_user'];
            $desc           ="Anda mendapatkan Komentar pada produk".$product['title_product']." telah tersedia.(".$_POST['receipt'].")";
            $this->send_notification_member($id_user,$desc,0,0,$id_comment,0);
        } else if ($_SESSION['status']=="user") {
            $desc="Anda mendapat komentar pada produk ".$product['title_product'];
            $this->send_notification_admin($desc,0,0,$id_comment,0);
        }        
        redirect(base_url('Product/'.$product['slug_product']));
        }else{      
        redirect(base_url('Product/'.$product['slug_product']));
        }
    }

}

/* End of file Comment.php */
