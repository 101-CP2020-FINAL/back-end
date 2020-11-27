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
                ['label' => 'Типы задач', 'icon' => 'list', 'url' => ['/ticket-types'], 'active' => $this->context->id == 'ticket-types',],
                ['label' => 'Приоритет задач', 'icon' => 'tags', 'url' => ['/ticket-priorities'], 'active' => $this->context->id == 'ticket-priorities',],
                ['label' => 'Типы сообщений', 'icon' => 'envelope', 'url' => ['/message-types'], 'active' => $this->context->id == 'message-types',],
                ['label' => 'Задачи', 'icon' => 'sticky-note', 'url' => ['/tickets'], 'active' => $this->context->id == 'tickets',],
                ['label' => 'Сообщения', 'icon' => 'comments', 'url' => ['/ticket-messages'], 'active' => $this->context->id == 'ticket-messages',],
            ],
        ]) ?>
    </section>
</aside>
