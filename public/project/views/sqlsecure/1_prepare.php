<h4>Подготовка</h4>
<p>
    Для дальнейшей работы, понадобятся несколько таблиц с данными
</p>
<style>
    table {
        border-collapse: collapse;
        margin-top: 20px;
    }
    caption {
        text-align:left;
    }
    td,th {
        padding: 8px;
        text-align:center;
        border:1px solid black;
        width: 100px;

    }
    th{
        background: silver;
    }
</style>
<table>
    <caption>Таблица: sec_users</caption>
    <thead>
        <tr>
            <th>id</th>
            <th>login</th>
            <th>password</th>
            <th>role</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>admin</td>
            <td>abcde</td>
            <td>1</td>
        </tr>
        <tr>
            <td>2</td>
            <td>user</td>
            <td>12345</td>
            <td>2</td>
        </tr>
    </tbody>
</table>
<table>
    <caption>Таблица: sec_prods</caption>
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>cost</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>prod1</td>
            <td>500</td>
        </tr>
        <tr>
            <td>2</td>
            <td>prod2</td>
            <td>600</td>
        </tr>
        <tr>
            <td>3</td>
            <td>prod3</td>
            <td>700</td>
        </tr>
    </tbody>
</table>
<table>
    <caption>Таблица: sec_notes</caption>
    <thead>
        <tr>
            <th>id</th>
            <th>text</th>
            <th>user_id</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>111 111 111</td>
            <td>1</td>
        </tr>
        <tr>
            <td>2</td>
            <td>222 222 222</td>
            <td>1</td>
        </tr>
        <tr>
            <td>3</td>
            <td>333 333 333</td>
            <td>2</td>
        </tr>
        <tr>
            <td>4</td>
            <td>444 444 444</td>
            <td>2</td>
        </tr>
    </tbody>
</table>
<p>
    Необходимо создать эти таблицы в Базе Данных для дальнейшей работы
</p>
<div class="navigate_arrow">
	<a href="/api/0_intro/">Назад</a>
	<a href="/sqlsecure/2_comments">Вперёд</a>
</div>