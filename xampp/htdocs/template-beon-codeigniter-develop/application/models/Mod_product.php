
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_product extends CI_Model {

  protected $product             = 'em_products';
  protected $product_img         = 'em_product_imgs';
  protected $product_measurement = 'em_product_measurements';
  protected $product_variant     = 'em_product_variations';
  protected $product_view        = 'em_product_views';
  protected $product_wishlist    = 'em_product_wishlists';
  protected $product_review      = 'em_product_reviews';
  protected $product_img_temp    = 'em_product_img_temps';
  protected $cart                = 'em_carts';
  protected $transaction          = 'em_transactions';
  protected $transaction_detail   = 'em_transaction_details';

  public function getListProduct(){
    $this->db->select('*');
    $this->db->from($this->product);
    $this->db->where('status', 1);
    $this->db->where('deleted_at',null);
    $this->db->order_by('created_at', 'desc');        
    return $this->db->get();
  }
  public function getListDraftProduct(){
    $this->db->select('*');
    $this->db->from($this->product);
    $this->db->where('status', 0);
    $this->db->where('deleted_at',null);
    $this->db->order_by('updated_at', 'desc');        
    return $this->db->get();
  }
  public function getView($id){
    $this->db->where('id_product', $id);
    $this->db->from($this->product_view);
    return $this->db->count_all_results();
  }
  public function getStock($id){
    $this->db->select_sum('qty');
    $this->db->from($this->product_variant);
    $this->db->where('id_product',$id );
    return $this->db->get();
  }
  //softdelete Product
  public function editProduct ($id, $data)
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update($this->product);
  }
  public function addProduct($data)
  {
    $this->db->insert($this->product, $data);
    return $this->db->insert_id();
  }
  // Search IMg by token
  public function whereImgsTemp($token){
    $this->db->where('token',$token['token']);
    $this->db->where('token_backup',$token['token_backup']);
    return  $this->db->get($this->product_img_temp);
  }
  // End Search img by token
  public function addImg($insert){
    $this->db->insert($this->product_img, $insert);
  }
  // Deleted Imgs temporary
  public function delTempImg($token)
  {
    $this->db->where('token', $token['token']);
    $this->db->where('token_backup', $token['token_backup']);      
    $this->db->delete($this->product_img_temp);   
  }
  // end Delete img temporary
  //get measurement
  public function getMeasurement()
  {
      return $this->db->get($this->product_measurement);
  }
  // end measurement
  // product Variation
  public function addVariation($variation){
    
    return $this->db->insert_batch($this->product_variant, $variation);
  }
  // End Product Variation
  // get Product By id
  public function getProductbyId($id)
  {
      $this->db->where('id', $id);
      $this->db->select('* , id as id_produk');
      return $this->db->get($this->product);
  }
  // end Get Product By id
  // get Variant by id_product
  public function getVariantByProduct($id){
    $this->db->where('qty >',0 );    
    $this->db->where('id_product', $id);
    return $this->db->get($this->product_variant);
  }
  // end Get variant by id_product
  // get Variant by id
  public function getVariantByid($id){
    $this->db->where('id', $id);
    return $this->db->get($this->product_variant);
  }
  public function CountVariant($id){
    $this->db->where('id_product',$id);
    $this->db->select('id_product as jumlah');
    return $this->db->get($this->product_variant);
  }
  // end get Variant by id
  // get img by id_product
  public function getImgByProduct($id){
    $this->db->select('*');
    $this->db->where('id_product', $id);
    $this->db->from($this->product_img); 
    return $this->db->get();
  }
  // end get img by id_product
  public function countProdukByCategory($id_category){
    $this->db->where(array('deleted_at' => null, 'status' => 1));
    $this->db->where('id_category', $id_category);
    $this->db->from($this->product);
    return $this->db->count_all_results();
  }
  public function getProductByCategory($id_category,$number,$offset){
    if(isset($_SESSION['id'])){
      return $this->db->query("select p.*,(select w.id from $this->product_wishlist w where w.id_product = p.id and w.id_user=".$_SESSION['id'].") as id_wishlist from $this->product p where p.deleted_at=0 and status=1 and p.id_category=$id_category order by created_at desc limit $number offset $offset"); 
    } else {
        $this->db->select('*');
        $this->db->where(array('deleted_at' => null, 'status' => 1, 'id_category' => $id_category));
        return $this->db->get($this->product,$number,$offset);
    }
  }
  public function getProductBySearch($keyword,$number,$offset)
  {
      if(isset($_SESSION['id'])){
          $keyword='%'.$keyword.'%';
          print_r($keyword);die();
          return $this->db->query("select p.*,(select w.id from $this->product_wishlist w where w.id_product = p.id_product and w.id_user=".$_SESSION['id'].") as id_wishlist, from $this->product p where p.deleted_at=000 and status=1 and p.title_product LIKE '$keyword' order by created_at desc limit $number offset $offset"); 
      } else {
      $this->db->select('*');
      $this->db->where(array('deleted_at' => 000, 'status' => 1));
      $this->db->like('title_product',$keyword);

      // sorting
      return $query = $this->db->get($this->product,$number,$offset);
      }
  }
  public function getImageThumb($id){
    $this->db->where('id_product', $id);
    $this->db->from($this->product_img);
    $this->db->order_by('id', 'ASC');
    $this->db->limit(1);
    return $this->db->get();
  }
  public function getProductBySlug($slug){
    if(isset($_SESSION['id'])){
      return $this->db->query("select p.*,(select id from $this->product_wishlist w where w.id_product = p.id and w.id_user=".$_SESSION['id'].") as id_wishlist from $this->product p where
         slug_product='$slug' and p.deleted_at = 0"); 
    } else{
      $this->db->where('slug_product', $slug);
      $this->db->where('deleted_at', 0);
      return $this->db->get($this->product);
    }
  }
  public function getImgProduct($id){
    $this->db->where('id_product', $id);
    $this->db->from($this->product_img);
    $this->db->order_by('id', 'ASC');
    return $this->db->get();
  }
  public function getRecentProduct($id_category){
    if(isset($_SESSION['id']) and $id_category != null){
      return $this->db->query
      ("select p.*,(select id from $this->product_wishlist w where w.id_product = p.id and w.id_user=".$_SESSION['id'].") as id_wishlist
        from $this->product p where p.id_category= $id_category and p.deleted_at = 0000 LIMIT 4"); 
    } else {
        $this->db->where(array('deleted_at' => null, 'status' => 1, 'id_category' => $id_category));
        $this->db->order_by('id', 'RANDOM');
        return $this->db->get($this->product,4);
    }
  }
  public function getImgsProduct($id){
    $this->db->where('id_product', $id);
    $this->db->from($this->product_img);
    $this->db->order_by('id', 'ASC');
    return $this->db->get();
  }
  public function getProductBestSeller(){
    if(isset($_SESSION['id'])){
      return $this->db->query("select p.*,p.id,t.id as id_transaction_transaction,td.id_transaction,td.id_product,(select w.id from $this->product_wishlist w where w.id_product = p.id and w.id_user=".$_SESSION['id'].") as id_wishlist
      from $this->transaction_detail td INNER JOIN  $this->product p ON td.id_product=p.id INNER JOIN $this->transaction t ON td.id_transaction=t.id where p.deleted_at=0 and p.status=1 and t.status = 3 GROUP BY td.id_product ORDER BY td.id_product limit 8"); 
    } else {
        $this->db->select('*');
        $this->db->where(array('deleted_at' => 000, 'status' => 1));
        return $this->db->get($this->product);
    }
  }
  public function countProdukBySearch($keyword)
  {
      $this->db->where(array('deleted_at' => 000, 'status' => 1));
      $this->db->where('deleted_at',null);
      $this->db->like('title_product',$keyword);
      $this->db->from($this->product);
      return $this->db->count_all_results();
  }
  public function countProdukBySearchFilter($keyword)
  {
      $this->db->where(array('deleted_at' => 0, 'status' => 1));
      $this->db->where('deleted_at',null);
      $this->db->where('price >=', $_GET['min']);  
      $this->db->where('price <=', $_GET['max']);  
      $this->db->where('rating >=', $_GET['score']);  

      $this->db->like('title_product',$keyword);
      $this->db->from($this->product);
      $this->db->order_by('price', $_GET['SortBy']);        
      return $this->db->count_all_results();
  }
  public function getProductBySearchFilter($keyword,$number,$offset)
  {
      if(isset($_SESSION['id'])){
          $keyword='%'.$keyword.'%';
          if ($_GET['SortBy']==1) {
              $sort=" created_at desc";
          } else if($_GET['SortBy']==2){
              $sort="p.price asc";
          } else $sort="p.price desc";
          return $this->db->query("select p.*,(select id from $this->product_wishlist w where w.id_product = p.id and w.id_user=".$_SESSION['id'].") as id_wishlist, (select id from $this->cart c where c.id_product = p.id and c.id_user=".$_SESSION['id'].") as id_cart
            from $this->table p wherep.deleted_at=000 and status=1 and p.title_product LIKE '$keyword' and p.price>=".$_GET['min']." and p.price<=".$_GET['max']." and rating>=".$_GET['score']." order by $sort limit $number offset $offset"); 
      }else{
      $this->db->select('*');
      $this->db->where(array('deleted_at' => 000, 'status' => 1));
      $this->db->like('title_product',$keyword);
      $this->db->where('price >=', $_GET['min']);  
      $this->db->where('price <=', $_GET['max']);  
      $this->db->where('rating >=', $_GET['score']);  

      // sorting
      if($_GET['SortBy'] == 1) $this->db->order_by('created_at', 'desc');
      elseif($_GET['SortBy'] == 2) $this->db->order_by('price', 'asc');
      else $this->db->order_by('price', 'desc');

      return $query = $this->db->get($this->table,$number,$offset);
      }
  }
  
  
}

/* End of file Mod_product.php */
