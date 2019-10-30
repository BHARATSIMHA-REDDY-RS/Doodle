<?php if(Route::has('login')): ?>
        <?php if(auth()->guard()->check()): ?>
        

        <?php $__env->startSection('content'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
        $(document).ready(function() {

          var tslotbtn=document.getElementById('addslots');
          tslotbtn.addEventListener("click",function(){
            // console.log("added time slot");
            var table = document.getElementById("myTable");
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML = "Date :<input type='date' name='date[]'>";
            cell2.innerHTML = "Start Time :<input type='time' name='starttime[]'>";
            cell3.innerHTML = "End Time :<input type='time' name='endtime[]'>";
            // cell1.innerHTML = "<?php echo Form::label('date[]', 'Date:'); ?><?php echo Form::Date('date[]'); ?>";
            // cell2.innerHTML = "<?php echo Form::label('starttime[]', 'Start Time:'); ?><?php echo Form::Time('starttime[]'); ?>";
            // cell3.innerHTML = "<?php echo Form::label('endtime[]', 'End Time:'); ?><?php echo Form::Time('endtime[]'); ?>";
          })
        });
        </script>
        <div class="container">
          <div class="row">
            <h1>Welcome</h1>
            <h4>Create New Event</h4>
            <hr>
            <div class="col-md-8 col-md-offset-2">
            <!-- <form>
            <div class="form-group">
            </div>
            </form> -->
            <?php echo Form::open(['route' => 'events.store']); ?>

            <?php echo Form::label('title', 'Title:'); ?>

            <?php echo Form::text('title', null,['class'=>'form-control']); ?>

            <?php echo Form::label('location', 'Location:'); ?>

            <?php echo Form::select('location', ['Skype' => 'Skype Meeting', 'TBD' => 'To be Decided', 'WebEx' => 'Cisco WebEx'], null, ['class' =>'form-control','placeholder' => 'Pick a Location for the Meeting...']);; ?>

            <?php echo Form::label('description', 'Description:'); ?>

            <?php echo Form::textarea('description', '',['class'=>'form-control','placeholder'=>'Optional note']); ?>

            <!-- <table class="table" id="myTable">
              <tr>
              <td>
                <?php echo Form::label('date[]', 'Date:'); ?>

                <?php echo Form::Date('date[]'); ?>

              </td>
              <td>
                <?php echo Form::label('starttime[]', 'Start Time:'); ?>

                <?php echo Form::Time('starttime[]'); ?>

              </td>
              <td>
                <?php echo Form::label('endtime[]', 'End Time:'); ?>

                <?php echo Form::Time('endtime[]'); ?>

              </td>
            </tr>
            </table> -->
            <table class="table" id="myTable">
              <tr>
                <td>Date :<input type="date" name="date[]"></td>
                <td>Start Time :<input type="time" name="starttime[]"></td>
                <td>End Time :<input type="time" name="endtime[]"></td>
              </tr>
            </table>
            <button class="btn btn-default btn-success" type="button" id="addslots">Add Time Slots</button>
            <hr>
            <?php echo Form::label('emaillist', 'Send To:'); ?>

            <?php echo Form::textarea('emaillist', '',['class'=>'form-control','placeholder'=>'Enter emails separated by semicolon']); ?>

            <?php echo Form::submit('Create Event',['class'=>'btn btn-success btn-lg']); ?>

            <?php echo Form::close(); ?>


            </div>
          </div>
        </div>
        <?php $__env->stopSection(); ?>
        <?php else: ?>
        <?php $__env->startSection('content'); ?>
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                <h2>Please login to create more events.<h2>
                </div>
              </div>
            </div>
        <?php $__env->stopSection(); ?>
        <?php endif; ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>