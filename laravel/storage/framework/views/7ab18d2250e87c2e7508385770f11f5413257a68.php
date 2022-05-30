<?php $__env->startSection('content'); ?>
   <style>
       #map{
           height:80vh;
           width:100%;
       }
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('You are logged in!')); ?>

                </div>

                <form method="POST" action="/home"><?php echo csrf_field(); ?>
                    <label for="cars">Selecteer welke klant u bent.</label>
                        <select id="klant" name="klant">
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($customer->ID_Klant); ?>"><?php echo e($customer->klantnaam); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <div id="map"></div>
                </form>

                <script src="<?php echo e(asset('js/map.js')); ?>"></script>
                <?php echo e($customers[0]->klantnaam); ?>

                <?php echo e($numberboards[0]->kenteken); ?>


                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <script>
                        L.marker([<?php echo e($location->latitude); ?>, <?php echo e($location->longitude); ?>]).addTo(map)
                        .bindPopup(
                            `
                            <div class="row">
                                <p class="col-xs-1 center-block text-center">
                                    Adres: <?php echo e($location->adres); ?><br>
                                    Postcode: <?php echo e($location->postcode); ?><br>
                                    Aantal plekken: <?php echo e($location->aantalplekken); ?><br>
                                </p>
                                <div class="col-xs-1 center-block text-center">
                                    <input type="hidden" name="latitude" value="<?php echo e($location->latitude); ?>">
                                    <input type="hidden" name="longitude" value="<?php echo e($location->longitude); ?>">
                                    <input type="hidden" name="name" value="<?php echo e($location->adres); ?>">
                                    <input type="submit" class="btn btn-primary" name="<?php echo e($location->id); ?>" value="Start parkeren">
                                </div>
                            </div>
                            `
                            )
                        .openPopup();
                    </script>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Examen\parkeerexamen\laravel\resources\views/home.blade.php ENDPATH**/ ?>