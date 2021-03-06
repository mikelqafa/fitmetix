<div class="widget-events widget-left-panel">
	<div class="menu-list">
		<ul class="list-unstyled">
			<li class="<?php echo (Request::segment(1)=='' ? 'active' : ''); ?>"><a href="<?php echo e(url('/')); ?>" class="btn"><i class="fa fa-trophy" aria-hidden="true"></i><?php echo e(trans('common.home')); ?></a></li>

			<?php if(Setting::get('enable_browse') == 'on'): ?>
				<li class="<?php echo (Request::segment(1)=='browse' ? 'active' : ''); ?>"><a href="<?php echo e(url('/browse')); ?>" class="btn"><i class="fa fa-globe" aria-hidden="true"></i><?php echo e(trans('common.browse')); ?> </a></li>
			<?php endif; ?>

			<li><a href="<?php echo e(url(Auth::user()->username)); ?>" class="btn"><i class="fa fa-user" aria-hidden="true"></i><?php echo e(trans('common.my_profile')); ?> </a></li>

			<li class="<?php echo (Request::segment(2)=='albums' ? 'active' : ''); ?>"><a href="<?php echo e(url('/'.Auth::user()->username.'/albums')); ?>" class="btn"><i class="fa fa-film" aria-hidden="true"></i><?php echo e(trans('common.albums')); ?></a></li>

			<li class="<?php echo (Request::segment(1)=='messages' ? 'active' : ''); ?>"><a href="<?php echo e(url('messages')); ?>" class="btn"><i class="fa fa-comments" aria-hidden="true"></i><?php echo e(trans('common.messages')); ?></a></li>

			<li><a href="<?php echo e(url(Auth::user()->username.'/pages')); ?>" class="btn"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo e(trans('common.pages')); ?> <span class="event-circle"><?php echo e(Auth::user()->own_pages()->count()); ?></span></a></li>

			<li><a href="<?php echo e(url(Auth::user()->username.'/groups')); ?>" class="btn"><i class="fa fa-group" aria-hidden="true"></i><?php echo e(trans('common.groups')); ?> <span class="event-circle"><?php echo e(Auth::user()->own_groups()->count()); ?></span></a></li>

			<li><a href="<?php echo e(url(Auth::user()->username.'/saved')); ?>" class="btn"><i class="fa fa-save" aria-hidden="true"></i><?php echo e(trans('common.saved_items')); ?> </a></li>

			<li><a href="<?php echo e(url('/'.Auth::user()->username.'/settings/general')); ?>" class="btn"><i class="fa fa-cog" aria-hidden="true"></i><?php echo e(trans('common.settings')); ?></a></li>
		</ul>
	</div>
	<div class="menu-heading">
		<?php echo e(trans('common.most_trending')); ?>

	</div>
	<div class="categotry-list">
		<ul class="list-unstyled">
			<?php if($trending_tags != ""): ?>
				<?php $__currentLoopData = $trending_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trending_tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><span class="hash-icon"><i class="fa fa-hashtag"></i></span> <a href="<?php echo e(url('?hashtag='.$trending_tag->tag)); ?>"><?php echo e($trending_tag->tag); ?></a></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php else: ?>
				<span class="text-warning"><?php echo e(trans('messages.no_tags')); ?></span>
				
			<?php endif; ?>
		</ul>
	</div>
</div><!-- /widget-events -->