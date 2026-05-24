<section class="grid gap-8 lg:grid-cols-[1fr_360px]">
    <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
        <p class="text-sm font-bold uppercase tracking-wide text-emerald-700">Smarty-rendered page</p>
        <h1 class="mt-3 text-3xl font-black tracking-tight text-zinc-950 sm:text-4xl">About {$appName|escape}</h1>
        <p class="mt-4 text-base leading-8 text-zinc-600">
            YipCommerce demonstrates a Laravel-inspired modular MVC flow while rendering this content through Smarty.
            Controllers can choose Blade for application screens or send view-model data into Smarty templates for
            framework compatibility work.
        </p>
        <a href="{$productsUrl|escape}" class="mt-6 inline-flex rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">
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
        <p class="mt-6 text-xs font-semibold uppercase tracking-wide text-zinc-500">© {$year|escape} YipCommerce</p>
    </aside>
</section>
