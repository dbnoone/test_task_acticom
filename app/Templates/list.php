<?php if ($this->data['list']) { ?>
    <div class="table-responsive mt-4">
        <table class="table table-dark table-sm">
            <thead>
            <tr>
                <th scope="col">Код</th>
                <th scope="col">Наименование</th>
                <th scope="col">Уровень 1</th>
                <th scope="col">Уровень 2</th>
                <th scope="col">Уровень 3</th>
                <th scope="col">Цена</th>
                <th scope="col">ЦенаСП</th>
                <th scope="col">Количество</th>
                <th scope="col">Поля свойств</th>
                <th scope="col">Совместные покупки</th>
                <th scope="col">Единица измерения</th>
                <th scope="col">Картинка</th>
                <th scope="col">Выводить на главной</th>
                <th scope="col">Описание</th>
            </tr>
            </thead>

            <?php foreach ($this->data['list'] as $product_data) { ?>
                <tbody>
                <tr>
                    <?php foreach ($product_data as $value) { ?>
                        <td><?= $value ?></td>
                    <?php } ?>
                </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>
<?php } ?>