<?php if($paginator->hasPages()): ?>
<nav class="stim-pagination-nav" aria-label="Navigasi Halaman">
    <ul class="stim-pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="stim-page-item disabled">
                <span class="stim-page-link stim-page-arrow" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </span>
            </li>
        <?php else: ?>
            <li class="stim-page-item">
                <a class="stim-page-link stim-page-arrow" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="Sebelumnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </a>
            </li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="stim-page-item disabled stim-page-dots">
                    <span class="stim-page-link"><?php echo e($element); ?></span>
                </li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="stim-page-item active" aria-current="page">
                            <span class="stim-page-link stim-page-number"><?php echo e($page); ?></span>
                        </li>
                    <?php else: ?>
                        <li class="stim-page-item">
                            <a class="stim-page-link stim-page-number" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="stim-page-item">
                <a class="stim-page-link stim-page-arrow" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="Selanjutnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </li>
        <?php else: ?>
            <li class="stim-page-item disabled">
                <span class="stim-page-link stim-page-arrow" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </li>
        <?php endif; ?>
    </ul>

    
    <p class="stim-pagination-info">
        Menampilkan <strong><?php echo e($paginator->firstItem()); ?></strong>–<strong><?php echo e($paginator->lastItem()); ?></strong>
        dari <strong><?php echo e($paginator->total()); ?></strong> <?php echo e($noun ?? 'dosen'); ?>

    </p>
</nav>
<?php endif; ?>
<?php /**PATH C:\Users\arief\stim_ykpn_edu\resources\views/vendor/pagination/bootstrap-4.blade.php ENDPATH**/ ?>