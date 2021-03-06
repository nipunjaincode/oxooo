<div class="card">
  <div class="row">
    <div class="col-md-12">
     <a class="btn btn-sm btn-primary waves-effect" href="<?php echo base_url('admin/videos'); ?>"> <span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back to List</a>
    </div>
  </div>
  <div class="row">         
    <div class="col-md-12">
      <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Upload Videos</h3>
          </div>
          <div class="panel-body">
              <div class="animated-radio-button radio-inline">
              <label>
                <input type="radio" name="radio-input" id="upload-active" ><span class="label-text">Upload</span>
              </label>
              <label>
                <input type="radio" name="radio-input"  id="link-active" checked><span class="label-text">From URL</span>
              </label>
            </div>

            <div id="upload_section" style="display: none;">
              <form action="<?php echo base_url('admin/video_upload'); ?>" method="post" enctype="multipart/form-data" id="MyUploadForm">
                <input type="hidden" name="videos_id" value="<?php echo $param1; ?>">
              <div class="form-group">
                <label class="control-label">Select File</label>
                <input name="FileInput" id="FileInput" type="file" />
              </div>               
              <button type="submit" class="btn btn-sm btn-primary waves-effect"> <span class="btn-label"><i class="fa fa-plus"></i></span>Upload Videos </button><br><br></form>
              <div id="progressbox">
                <div class="progress progress-striped active">
                  <div id="progressbar" class="progress-bar" style="width: 0%;"></div>                    
                </div>
                <center>
                <div id="statustxt">0%</div>
                </center>
              </div>
              <div id="output" class="text-danger"></div>
            </div>
              <div id="link_section" >
                <div class="form-group">
                  <label class="control-label">Source</label>
                    <select class="form-control" name="source" id="selected-source">
                      <option value="mp4" selected>MP4 From URL</option>
                      <option value="mkv">MKV From URL</option>                      
                      <option value="youtube">Youtube</option>                    
                      <option value="amazone">Amazone S3</option>                    
                      <option value="webm">WEBM From URL</option>
                      <option value="m3u8">M3U8 From URL</option>
                      <option value="embed">Embed URL</option>
                      <option value="vimeo">Vimeo</option>
                    </select>
                </div>
                <div class="form-group" id="_source1">
                  <label class="control-label" >URL</label>&nbsp;&nbsp;<input id="video_url" type="url" name="embed_link[]" class="form-control" placeholder="http://server-2.com/movies/titalic.mp4" required=""><br>
                <button class="btn btn-sm btn-primary waves-effect" id="add-link"> <span class="btn-label"><i class="fa fa-plus"></i></span>add </button>
              </div>
            </div>             
        </div>
    </div>
    <?php echo form_open(base_url() . 'admin/file_and_download/update_video_file/'.$param1 , array('class' => 'form-horizontal group-border-dashed', 'enctype' => 'multipart/form-data'));?>
    <div class="panel panel-border panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">video list</h3>
        </div>
        <div class="panel-body">                 
          <table class="table table-bordered" id="video-list">
            <thead>
              <tr>
                <th>#</th>
                <th>URL(Source)</th>
                <th>URL</th>
                <th>Action</th>
              </tr>
            </thead>
            <?php 
              $sl = 0;
              $video_files = $this->db->get_where('video_file', array('videos_id'=> $param1))->result_array();
              foreach($video_files as $video_file):
                $sl++;
             ?>
            <tr id="row_<?php echo $video_file['video_file_id']; ?>">
              <td><?php echo $sl; ?></td>
              <td><?php echo 'Server-'.$sl.'('.$video_file['file_source'].')'; ?></td>
              <td><?php echo urldecode($video_file['file_url']); ?></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-white btn-sm dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                  <ul class="dropdown-menu" role="menu">                                        
                    <li><a class="dropdown-item" title="delete'); ?>" href="#" onclick="delete_row('video_file',<?php echo urldecode($video_file['video_file_id']);?>)" class="delete">Delete</a> </li>
                  </ul>
                </div>
              </td>
            </tr>             
          <?php endforeach; ?>
          </table>
          <?php echo form_close(); ?>          
      </div>
    </div>
  </div>
<!-- <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            //target:   '#output',   // target element(s) to be updated with server response 
            beforeSubmit: beforeSubmit, // pre-submit callback 
            success: afterSuccess, // post-submit callback 
            uploadProgress: OnProgress, //upload progress callback 
            resetForm: true // reset the form after successful submit 
        };

        $('#MyUploadForm').submit(function() {
            $(this).ajaxSubmit(options);
            // always return false to prevent standard browser submit and page navigation 
            return false;
        });


        //function after succesful file upload (when server response)
        function afterSuccess(data) {
            var response = JSON.parse(data);
            var status = response.status;
            $('#submit-btn').show(); //hide submit button
            //$('#loading-img').hide(); //hide submit button
            $('#progressbox').delay(1000).fadeOut(); //hide progress bar
            if (status == 'success') {
                $('#video-list').append(response.video_info);
                swal('Good job!','Video upload successfully ','success');
            } else {
                swal('OPPS!',response.errors ,'error');
                //$("#output").html(response.errors);
            }
        }

        //function to check file size before uploading.
        function beforeSubmit() {
            //check whether browser fully supports all File API
            if (window.File && window.FileReader && window.FileList && window.Blob) {

                if (!$('#FileInput').val()) //check empty input filed
                {
                    //$("#output").html("Please select at least one video file!!");
                    swal('OPPS!',"Please select at least one video file!!" ,'error');
                    return false
                }

                var fsize = $('#FileInput')[0].files[0].size; //get file size
                var ftype = $('#FileInput')[0].files[0].type; // get file type
                //allow file types 
                switch (ftype) {
                    case 'video/webm':
                    case 'video/avi':
                    case 'video/msvideo':
                    case 'video/x-msvideo':
                    case 'video/mp4':
                    case 'video/mpeg':
                    case 'video/x-matroska':
                    case 'video/x-mkv':
                    case 'video/mkv':
                    case 'application/x-mpegurl':                   
                        break;
                    default:
                        swal('OPPS!',"<b>" + ftype + "</b> Unsupported file type/format/extention!" ,'error');
                        return false
                }

                //Allowed file size is less than 5 GB (1048576)
                if (fsize > 5000242880) {
                    $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big file! <br />File is too big, it should be less than 5 MB.");
                    return false
                }

                $('#submit-btn').hide(); //hide submit button
                $('#loading-img').show(); //hide submit button
                $("#output").html("");
                $('#progressbar').width('0%') //update progressbar percent complete
                $('#statustxt').html('0%'); //update status text  
            } else {
                //Output error to older unsupported browsers that doesn't support HTML5 File API
                $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                return false;
            }
        }

        //progress bar function
        function OnProgress(event, position, total, percentComplete) {
            //Progress bar
            $('#progressbox').show();
            $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
            $('#statustxt').html(percentComplete + '%'); //update status text
            if (percentComplete > 50) {
                $('#statustxt').css('color', '#000'); //change status text to white after 50%
            }
        }

        //function to format bites bit.ly/19yoIPO
        function bytesToSize(bytes) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0) return '0 Bytes';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }

    });
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script>
    $(document).ready(function() {
      $("#upload-active").click(function(){
        $("#upload_section").show();
        $("#link_section").hide();
      });
      $("#link-active").click(function(){
        $("#upload_section").hide();
        $("#link_section").show();
      });
       
       $("#add-link").click(function(){
        $(this).html('<span class="btn-label"><i class="fa fa-plus"></i></span>Adding..');
        var  type = $("#selected-source").val();
        var  base_url = "<?php echo base_url(); ?>";
        var  url  = $("#video_url").val();
        var  videos_id  = "<?php echo $param1; ?>";
        if (isUrl(url)==true && url !='' && type!='') {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url().'admin/video_file/';?>",
                data: "videos_id="+videos_id+"&type=" + type + "&url=" + encodeURIComponent(url),
                dataType: 'json',
                success: function(response) {
                    var post_status = response.post_status;
                    var row_id = response.row_id;
                    var type = response.type;
                    var url = response.url;                    
                    var watch_url = response.watch_url;                    
                    if (post_status == "success") {
                      var html_text = '<tr id="row_'+row_id+'"><td>#</td><td>Server('+type+')</td><td>'+url+'</td><td></td><td><div class="btn-group"><button type="button" class="btn btn-white btn-sm dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button><ul class="dropdown-menu" role="menu">s<li><a class="dropdown-item" title="Delete" href="#" onclick="delete_row('+"'video_file',"+row_id+')" class="delete">Delete</a> </li></ul></div></td></tr>';
                      $('#video-list').append(html_text);
                      $("#add-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add');
                      $("#url").val('');
                      $("#add-download-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add to List');
                      $("#video_url").val('');
                      swal('Good job!','Video added successfully ','success');
                      //alert('Link Added to video.');
                    } else {
                      $("#add-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add');
                      swal('OPPS!',post_status ,'error');
                        //alert(post_status); 
                    }

                }
            });
        }else{
          $("#add-download-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add to List');
          $("#add-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add to List');
          swal('OPPS!',"please enter a valid url and title" ,'error');
        }
      });
       $("#add-download-link").click(function(){
        $(this).html('<span class="btn-label"><i class="fa fa-plus"></i></span>Adding..');
        var  link_title = $("#link_title").val();
        var  download_url  = JSON.stringify($("#download_url").val());
        var  videos_id  = "<?php echo $param1; ?>";
        if (isUrl(download_url)==true && download_url !='' && link_title !='') {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url().'admin/download_link/';?>",
                data: "videos_id="+videos_id+"&link_title=" + link_title + "&download_url=" + encodeURIComponent(download_url),
                dataType: 'json',
                success: function(response) {
                    var post_status = response.post_status;
                    var row_id = response.row_id;
                    var link_title = response.link_title;
                    var download_url = response.download_url;                    
                    if (post_status == "success") {
                      var html_text ='<tr id="row_'+row_id+'"><td><a class="dropdown-item" href="'+download_url+'"><strong>'+link_title+'</strong></a></td><td><a href="'+download_url+'">'+download_url+'</a></td><td><a title="delete" class="btn btn-icon" onclick="delete_row('+"'download_link',"+row_id+')" class="delete"><i class="fa fa-remove"></i></a></td></tr>';
                      $('#download-link-list').append(html_text);
                      $("#link_title").val('');
                      $("#download_url").val('');
                      $("#add-download-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add to List');

                      swal('Good job!','Download link added successfully ','success');
                    } else {
                      $("#add-download-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add to List');
                        swal('OPPS!',post_status ,'error'); 
                    }
                }
            });
        }else{
          $("#add-download-link").html('<span class="btn-label"><i class="fa fa-plus"></i></span>Add to List');
          swal('OPPS!',"please enter a valid url and title" ,'error');
        }
      });
    });
</script>
<script>
function isUrl(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(s);
}
</script>
<script src="<?php echo base_url() ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

