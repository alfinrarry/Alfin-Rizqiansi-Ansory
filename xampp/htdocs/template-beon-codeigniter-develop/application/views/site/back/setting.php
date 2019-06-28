<div class="container-fluid" data-codepage="<?php echo $codepage?>">
  <?php echo form_open_multipart('');?>
  <div class="row">
    <div class="col-4">    
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label for="name">Favicon</label>
            <input type="file" id="input-file-disable-remove" name="favicon" class="dropify" data-default-file="" data-show-remove="false" />
          </div>
          <div class="form-group">
            <label for="name">Logo Web</label>
            <input type="file" id="input-file-disable-remove" name="logo" class="dropify" data-default-file="" data-show-remove="false" />
          </div>
        </form>
        </div>  
      </div>
    </div>
    <div class="col-8">
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label for="name">Judul Sistem</label>
            <input type="text" name="title" id="title" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="name">Deskripsi</label>
            <textarea name="description" id="" cols="30" class="form-control" rows="10"></textarea>
          </div>
          <div class="form-group">
            <label for="name">Meta Tag</label>
            <textarea data-role='tags-input' name="tags" id="" cols="30" class="form-control" rows="10"></textarea>
          </div>
          <div class="form-group m-b-0 text-right">
            <button class="btn btn-success btn-sm waves-effect waves-light" type="submit" name="submit"><span class="btn-label"><i class="fas fa-cogs"></i></span> Update</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  </form>
</div>