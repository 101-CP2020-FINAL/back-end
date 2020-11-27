<aside class="main-sidebar">
    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
            'items' => [
                ['label' => 'Главная', 'icon' => 'home', 'url' => ['/'], 'active' => $this->context->id == 'site',],
                ['label' => 'Сервисы', 'icon' => 'lock', 'url' => ['/internal-services'], 'active' => $this->context->id == 'internal-services',],
            ],
        ]) ?>
    </section>
</aside>
