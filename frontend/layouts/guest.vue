<template>
    <div class="bg-light min:h-screen">
        <div class="flex">
            <section class="w-3/5 h-screen flex justify-center items-center">
                <h1 class="text-[8rem] font-bold text-secondary [text-shadow:_0_1px_0_rgb(0_0_0_/_60%)]">mCast</h1>
            </section>
            <section class="w-2/5 flex items-center bg-secondary-light border-l-2 px-6">
                <div class="w-full">
                    <slot />
                </div>
            </section>
        </div>
    </div>
</template>
