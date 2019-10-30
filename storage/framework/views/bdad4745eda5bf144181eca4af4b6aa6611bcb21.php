<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="createnewevent">
                      <a href="/events/create"><button type="button" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-plus"></span>  Create new event</button></a>
                      <!-- <a href="/events/create"><button type="button" class="btn btn-primary btn-lg">Create new Poll</button></a> -->
                    </div>
                     <div class="eventcontainerlist">
                      <h2>Your Events</h2>
                      <table class="table">
                        <thead>
                          <th>#</th>
                          <th>Title</th>
                          <th>Description</th>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($event->id); ?></td>
                              <td><?php echo e($event->title); ?></td>
                              <td><?php echo e(substr($event->description,0,50)); ?><?php echo e(strlen($event->description)>50?"...":""); ?></td>
                              <td><a href="<?php echo e(route('events.show',$event->id)); ?>" class="btn btn-sm btn-default">Administer</a></td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- You are logged in! -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>