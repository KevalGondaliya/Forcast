  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/importdata.js"></script>

<div class="row">
    <div class="col-lg-12"> 
        <h1>Data <small>Overview</small></h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-list"></i> Import Members</li>
        </ol>            
    </div>
</div>


<?php
$output = '';
$output .= form_open_multipart('ImportExcelController/save');
$output .= '<div class="row">';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
$output .= form_label('Import Sheet', 'image');
$data = array(
    'name' => 'userfile',
    'id' => 'userfile',
    'class' => 'form-control filestyle',
    'value' => '',
    'data-icon' => 'false'
);
$output .= form_upload($data);
$output .= '</div> <span style="color:red;">*Please choose an Excel file(.xls or .xlsx) as Input</span></div>';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right">';
$data = array(
    'name' => 'importfile',
    'id' => 'importfile-id',
    'class' => 'btn btn-primary',
    'value' => 'Import',
);
$output .= form_submit($data, 'Import Data');
$output .= '</div>
                        </div></div>';
$output .= form_close();
echo $output;
?>

<div class="table-responsive">
    <table border="1" class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="editbutton">Action</i></th>
                <th class="reg_no">Reg No.</th>
                <th class="owner_name">Owner Name</th>                           
                <th class="address">Address</th>                      
                <th class="regn_date">Registration Date</th>
                <th class="maker">Maker</th>
                <th class="maker_model">Maker Model</th>
                <th class="mobile">Mobile</th>                           
                <th class="import_date">Import Date</th>                      
                <th class="last_date">Last Date</th>
                <th class="next_date">Next Date</th>
                <th class="modify_date">Modify Date</th>
                <th class="note">Note</th>                           
                <th class="vehicle_type">Vehicle Type</th>  

            </tr>
        </thead>
        <tbody>
            <?php



            if (isset($importdata) && !empty($importdata)) {

                foreach ($importdata as $element) {
                    ?>
                    <tr>
                      <td>
<button type="button" class="btn btn-default btn-lg" id="myBtn" data-toggle="modal" data-target="#myModal">Edit</button>
                          
                      </td>
                        <td><?php echo $element['reg_no']; ?></td> 
                        <td><?php echo $element['owner_name']; ?></td>                       
                        <td><?php echo $element['address']; ?></td>
                        <td><?php echo $element['regn_date']; ?></td>
                        <td><?php echo $element['maker']; ?></td>   
                        <td><?php echo $element['maker_model']; ?></td> 
                        <td><?php echo $element['mobile']; ?></td>                       
                        <td><?php echo $element['import_date']; ?></td>
                        <td><?php echo $element['last_date']; ?></td>
                        <td><?php echo $element['next_date']; ?></td>   
                        <td><?php echo $element['modify_date']; ?></td> 
                        <td><?php echo $element['note']; ?></td>     
                        <td><?php echo $element['vehicle_type']; ?></td>   
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="13">There is no employee.</td>    
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>





  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
