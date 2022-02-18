<template>
    <section>

        <b-collapse :open="false" aria-id="contentId001" class="box">
            <template #trigger>
               <a aria-controls="contentId001">
                   <h4 class="title is-4">Как добавить автомобиль</h4>
               </a>
            </template>
            <div class="notification">
                <div class="content">
                    <div class="columns">
                        <div class="column">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/d21clYgXWeY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="column">
                            Описание данного видео....
                        </div>
                    </div>
                </div>
            </div>
        </b-collapse>

        <b-collapse :open="false" aria-id="contentId002" class="box">
            <template #trigger>
                <a aria-controls="contentId002">
                    <h4 class="title is-4">Как сделать заказ</h4>
                </a>
            </template>
            <div class="notification">
                <div class="content">
                    <div class="columns">
                        <div class="column">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/d21clYgXWeY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="column">
                            Описание данного видео....
                        </div>
                    </div>
                </div>
            </div>
        </b-collapse>

        <b-collapse :open="false" aria-id="contentId003" class="box">
            <template #trigger>
                <a aria-controls="contentId003">
                    <h4 class="title is-4">Как закрыть заказ</h4>
                </a>
            </template>
            <div class="notification">
                <div class="content">
                    <div class="columns">
                        <div class="column">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/d21clYgXWeY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="column">
                            Описание данного видео....
                        </div>
                    </div>
                </div>
            </div>
        </b-collapse>

        <b-collapse :open="false" aria-id="contentId004" class="box">
            <template #trigger>
                <a aria-controls="contentId004">
                    <h4 class="title is-4">Как выбрать предложение мастерской</h4>
                </a>
            </template>
            <div class="notification">
                <div class="content">
                    <div class="columns">
                        <div class="column">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/d21clYgXWeY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="column">
                            Описание данного видео....
                        </div>
                    </div>
                </div>
            </div>
        </b-collapse>

    </section>
</template>

<script>
export default {
    name: "CustomerHelp",
}
</script>

<style scoped>
.collapse:not(.show) {
    display: block;
}

.content {
    margin-bottom: 0 !important;
}
</style>
