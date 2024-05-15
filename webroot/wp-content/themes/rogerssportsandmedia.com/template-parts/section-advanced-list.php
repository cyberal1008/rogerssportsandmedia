<!-- ADVANCED SOLUTIONS-->
<?php if( have_rows('adv_list_items') ) : 
	$adv_section_title = get_field('adv_section_title');
	$adv_intro_content = get_field('adv_intro_content');
	?>
	<section id="advanced" class="tw-bg-white tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96">
		<?php if ($adv_section_title) : ?>
        	<div class="tw-text-3xl md:tw-text-4xl tw-text-gray-dark tw-font-bold tw-mb-3"><?php echo $adv_section_title; ?></div>
		<?php endif; ?>
        <div class="tw-mb-6"><?php echo $adv_intro_content; ?></div>
        <div class="tw-grid tw-gap-y-8 tw-grid-cols-1 md:tw-grid-cols-2">
			<?php $adv_ctr = 0; while( have_rows('adv_list_items') ) : the_row(); $adv_ctr++;
				$title = get_sub_field('title');
				$content = get_sub_field('content');
			?>
				<div class="tw-flex-col">
					<div class="tw-flex tw-space-x-3">
						<div class="tw-w-2/12 tw-flex tw-items-center">
							<div class="tw-bg-red tw-w-12 tw-h-12 md:tw-w-16 md:tw-h-16 tw-flex tw-items-center tw-justify-center tw-rounded-full">
								<span class="tw-text-white tw-text-2xl tw-font-bold"><?php echo $adv_ctr; ?></span>
							</div>
						</div>
						<span class="tw-w-9/12 md:tw-text-xl tw-font-semibold"><?php echo $title; ?></span>
						<button id="accordion-button-<?php echo $adv_ctr; ?>" onclick="toggleAccordion(<?php echo $adv_ctr; ?>)" class="tw-w-1/12 tw-flex tw-items-center md:tw-hidden" aria-expanded="false" aria-controls="accordion-<?php echo $adv_ctr; ?>-content">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-12 tw-h-12">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
							</svg>                      
						</button>
					</div>
					<div id="accordion-<?php echo $adv_ctr; ?>-content" class="tw-hidden md:tw-flex tw-space-x-0 md:tw-space-x-3 tw-transition tw-duration-150 tw-ease-in">
						<div class="tw-w-0 md:tw-w-2/12">&nbsp;</div>
						<div class="tw-w-full md:tw-w-9/12">
							<?php echo $content; ?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
        </div>
	</section>
<?php endif; ?>


<script>
    function toggleAccordion(accordionId) {
      var accordionContent = document.getElementById(`accordion-${accordionId}-content`);
      var toggleButton = document.getElementById(`accordion-button-${accordionId}`);

      accordionContent.classList.toggle('tw-hidden');

      if (toggleButton.innerHTML.includes("M12 4.5v15m7.5-7.5h-15")) {
            toggleButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-12 tw-h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                </svg>
            `;
      } else {
            toggleButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-12 tw-h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            `;
      }
    }
  </script>