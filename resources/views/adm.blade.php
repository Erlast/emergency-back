
@extends("start")

@section('divtype')
    "container"
@endsection

@section("content")
    <table class="table table-info table-borderless">
        <thead class="table-dark">
            <tr>
                <th colspan="3">
                   АРМ Контент-менеджера
                </th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                Пожалуйста, выберите раздел
            </td>
            <td>
                <select id="sel_vol">
                    <option value="0">-----</option>
                    <option value="mis">МИС</option>
                    <option value="lis">МИС->ЛИС</option>
                    <option value="covid">МИС->COVID19</option>
                    <option value="aptech">МИС->Аптека</option>
                    <option value="nach">отказники</option>
                    <option value="eln">ЭЛН</option>
                    <option value="poly">Поликлиника</option>
                    <option value="prikaz">Приказы</option>
                    <option value="blank">Бланки</option>
                    <option value="video">Видео</option>
                    <option value="telemed">Телемедицина</option>
                    <option value="sec">Инф.без.</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Введите название документа:
            </td>
            <td>
                <input type="text" id="tdname" />
            </td>
        </tr>
        <tr>
            <td>
                Выберите файл с документом:
            </td>
            <td>
                <input type="file" id="uplfname" multiple>
            </td>
        </tr>
        <tr>
            <td colspan="3">
		<button type="button" class="btn btn-success" id="add_data_button">
		     <i class="bi bi-cloud-arrow-down-fill"></i>&nbspДобавить
		</button>
	    </td>
        </tr>
            <tr >
                <th class="table-dark"colspan="3">
                   Добавление новостей
                </th>
            </tr>
        <tr>
            <td>
                Введите заголовок новости:
            </td>
            <td>
                <input type="text" id="news_tit" />
            </td>
        </tr>
        <tr>
            <td colspan="3">
		<p style="color: red; font-weight: bold">Перевод строки - shift+enter!!!!</>
	    </td>
        </tr>

        <tr>
            <td>
                Введите содержание новости:
            </td>
            <td>
                <textarea name="editor1" id="editor1" cols="40" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="3">
		<button type="button" class="btn btn-success" id="add_news_button">
		     <i class="bi bi-info-circle-fill"></i>&nbspДобавить
		</button>
	    </td>
        </tr>
	
        </tbody>
    </table>

@endsection
