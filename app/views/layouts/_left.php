<aside class="main-sidebar">
    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
            'items' => [
                ['label' => 'Главная', 'icon' => 'home', 'url' => ['/'], 'active' => $this->context->id == 'site',],
                ['label' => 'Сервисы', 'icon' => 'lock', 'url' => ['/internal-services'], 'active' => $this->context->id == 'internal-services',],
                ['label' => 'Роли', 'icon' => 'user-secret', 'url' => ['/roles'], 'active' => $this->context->id == 'roles',],
                ['label' => 'Отделы', 'icon' => 'building', 'url' => ['/departments'], 'active' => $this->context->id == 'departments',],
                ['label' => 'Группы', 'icon' => 'users', 'url' => ['/groups'], 'active' => $this->context->id == 'groups',],
                ['label' => 'Сотрудники', 'icon' => 'user', 'url' => ['/employers'], 'active' => $this->context->id == 'employers',],
                ['label' => 'Штат сотрудников', 'icon' => 'users', 'url' => ['/staff'], 'active' => $this->context->id == 'staff',],
            ],
        ]) ?>
    </section>
</aside>
