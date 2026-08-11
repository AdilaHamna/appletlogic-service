<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header('custom');
?>

<div class="page">
  <section class="page-hero" style="min-height: 70vh; display: flex; align-items: center; justify-content: center; position: relative; padding: 120px 0;">
    <div class="bgnum" style="opacity: 0.04; font-size: 28vw; pointer-events: none;">404</div>
    <div class="wrap" style="text-align: center; max-width: 600px; z-index: 2;">
      <span class="eyebrow rv" style="display: inline-block; margin-bottom: 24px;">Page not found</span>
      <h1 class="rv-blur" style="font-size: 3rem; margin-bottom: 20px; line-height: 1.1;">Lost in <span class="grad-txt">cyberspace</span>?</h1>
      <p class="lead rv" style="margin-bottom: 40px; color: var(--muted);">The page you are looking for does not exist or has been moved. Let's get you back on track.</p>
      <div class="rv" style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-ghost" style="padding: 14px 28px;">Go Home</a>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn" style="padding: 14px 28px; background: var(--crimson); border-color: var(--crimson); color: #fff;">Contact Support</a>
      </div>
    </div>
  </section>
</div>

<?php
get_footer('custom');
