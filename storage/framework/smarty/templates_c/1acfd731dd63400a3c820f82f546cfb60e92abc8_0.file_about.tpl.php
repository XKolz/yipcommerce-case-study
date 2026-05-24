<?php
/* Smarty version 5.8.0, created on 2026-05-22 18:34:00
  from 'file:about.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a10a198133ad4_58815183',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1acfd731dd63400a3c820f82f546cfb60e92abc8' => 
    array (
      0 => 'about.tpl',
      1 => 1779474299,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a10a198133ad4_58815183 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/user/Desktop/yipcommerce-case-study/resources/smarty';
?><section class="grid gap-8 lg:grid-cols-[1fr_360px]">
    <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
        <p class="text-sm font-bold uppercase tracking-wide text-emerald-700">Smarty-rendered page</p>
        <h1 class="mt-3 text-3xl font-black tracking-tight text-zinc-950 sm:text-4xl">About <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('appName'), ENT_QUOTES, 'UTF-8', true);?>
</h1>
        <p class="mt-4 text-base leading-8 text-zinc-600">
            YipCommerce demonstrates a Laravel-inspired modular MVC flow while rendering this content through Smarty.
            Controllers can choose Blade for application screens or send view-model data into Smarty templates for
            framework compatibility work.
        </p>
        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('productsUrl'), ENT_QUOTES, 'UTF-8', true);?>
" class="mt-6 inline-flex rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">
            Browse catalog
        </a>
    </div>
    <aside class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-black text-zinc-950">MVC Placement</h2>
        <dl class="mt-4 space-y-4 text-sm">
            <div>
                <dt class="font-bold text-zinc-800">Controller</dt>
                <dd class="mt-1 text-zinc-600">Builds the page data and delegates rendering.</dd>
            </div>
            <div>
                <dt class="font-bold text-zinc-800">Service</dt>
                <dd class="mt-1 text-zinc-600">Configures Smarty template, cache, and compile paths.</dd>
            </div>
            <div>
                <dt class="font-bold text-zinc-800">Template</dt>
                <dd class="mt-1 text-zinc-600">Escapes output and keeps presentation separate from domain logic.</dd>
            </div>
        </dl>
        <p class="mt-6 text-xs font-semibold uppercase tracking-wide text-zinc-500">© <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('year'), ENT_QUOTES, 'UTF-8', true);?>
 YipCommerce</p>
    </aside>
</section>
<?php }
}
