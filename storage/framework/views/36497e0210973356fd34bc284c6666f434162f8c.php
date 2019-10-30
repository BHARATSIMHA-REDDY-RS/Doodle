<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="row">
    <h1><?php echo e($event->title); ?></h1>
    <!-- <h3>What's the occasion?</h3> -->
    <hr>
    <div class="col-md-10 col-md-offset-1">
      <p class="lead"><?php echo e($event->description); ?></p>
      <!-- <form method='POST' action='/participant/create' id='participant-form'> -->
      <?php echo Form::open(['route' => 'participant.create']); ?>

      <table class="table">
        <tr>
          <th></th>
          <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th class='text-center'>
              <?php echo e(date('d F Y', strtotime($date->date))); ?>

              <!-- <?php echo e($date->date); ?> -->
            </th>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>
            PARTICIPANTS
          </th>

        <?php $__currentLoopData = $timeslots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <td>
            <table>
              <tr class='text-center'>
                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td >
                <?php echo e(date('h:i A', strtotime($ama->starttime))); ?>-<?php echo e(date('h:i A', strtotime($ama->endtime))); ?>

                </td>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            </table>
          </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>

        <?php $__currentLoopData = $names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($values->emailid); ?></td>
          <?php
          $counter=1;
          $prev_date="";
          $curr_date="";
          ?>
          <?php $__currentLoopData = $variable[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $joinRes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $curr_date=$joinRes->date;
            if(strcmp($curr_date,$prev_date)){
              $counter=1;
            }

            $countSlots=App\EventSlot::where('eventid',$id)->where('date',$joinRes->date)->count();
            if($counter==1){
              echo "<td><table border='0'><tr>";

            }
            if($joinRes->response==1)
            {
              echo "<td width='150' style='background-color: #90EE90;' align='center'><font color='green'>&#10004;</font></td>";
            }else {
              echo "<td width='150' style='background-color: #FFB6C1;' align='center'><font color='red'>&#10008;</font></td>";
            }
            if($counter==$countSlots){
              echo "</tr></table></td>";
            }
            $counter++;
            $prev_date=$curr_date;
             ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php
            $queryresults=App\EventSlot::select('slotid','date')->where('eventid',$id)->orderBy('date')->orderBy('slotid')->get();
            // echo "<form method='POST' action='/participant/create' id='participant-form'>";
            // <td width='155'>
            // <input type='email' placeholder='Enter your email-id' required name='name'/>
            // </td>
            $counter=1;
            $prev_date="";
            $curr_date="";
            echo "<tr>";
            echo "<td width='155'>";
            echo "<input type='email' placeholder='Enter your email-id' required name='name'/>";
            echo "</td>";
            foreach($queryresults as $result){
                      $curr_date=$result->date;
                      if(strcmp($curr_date, $prev_date)){
                        $counter=1;
                      }
                      $dt=$result->date;
                      $countSlots=App\EventSlot::where('eventid',$id)->where('date',$dt)->count();
                      //echo $counter."%".$count."%".$dt;
                      if($counter==1){
                        echo "<td>";
                        echo "<table>";
                        echo "<tr>";
                      }
                      $slot=$result->slotid;
                      // echo "<td width='155' align='center' style='background-color: #D3D3D3;'>";
                      // echo "<input type='checkbox' name='check[]' id='slot' value='".$slot."'>"."</td>";
                      echo "<td width='155' align='center' style='background-color: #D3D3D3;'>"."<input type='checkbox' name='check[]' id='slot' value='$slot'>"."</td>";
                      if($counter==$countSlots){
                        echo "</tr>";
                        echo "</table>";
                        echo "</td>";
                      }
                      $counter++;
                      $prev_date=$curr_date;
            }
        echo "</tr>";
        echo "<input type='hidden' name='eventid' value='".$id."'>";
        echo "<tr><td><input class='btn btn-default btn-success' type='submit' value='Submit'></td></tr>";
        echo "</form>";
        ?>
      </table>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>