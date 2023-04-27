var countCategoryCoding = 0;
var countTypeCoding = 0;
var countCoverageArea = 0;
var countAvalibleTime = 0;
var countNotAvalible = 0;

function getInputHtml (id, label, name) {
	if (!name) name = id;
	return "<div class=\"form-group\"><label for= " + id + ">" + label + "</label ><input type='text' class='form-control' id='" + id + "' name='" + name +"' value=''></div>";
}

$(document).ready(function(){
	var dayOfWeek = '<div class="form-group"><div>';
	$.each(
	[
		{ val: 'mon', name: 'Понеділок' },
		{ val: 'tue', name: 'Вівторок' },
		{ val: 'thu', name: 'Середа' },
		{ val: 'tue', name: 'Четверг' },
		{ val: 'fri', name: "П'ятниця" },
		{ val: 'sat', name: 'Субота' },
		{ val: 'sun', name: 'Неділя' },
	],function (i, data) { dayOfWeek += getCheckDayHtml(data.val, data.name); });
	dayOfWeek += '</div></div>';

	$(document).on('click', '.moveParent', function(){ $(this).parent().remove(); });
	$(document).on('click', '.removeCoverageArea', function(){ $(this).parent().parent().remove(); });

	var btnRemoveBlock = '<button type="button" class="btn btn-danger moveParent">Видалити</button>';

	$('#addCategoryCoding').click(function() {
		var insert = getInputHtml('categorySystem' + countCategoryCoding, 'Система', 'categorySystem[]') + getInputHtml('categoryCode[]' , 'Код');
		$('#categoryCoding').prepend('<div id="categoryCode' + countCategoryCoding + '">' + insert + btnRemoveBlock + '</div>')
		$('#categorySystem' + countCategoryCoding).focus();
		countCategoryCoding++;
	});
	
	$('#addTypeCoding').click(function () {
		var insert = getInputHtml('typeSystem' + countTypeCoding, 'Система', 'typeSystem[]') + getInputHtml('typeCode[]', 'Код');
		$('#typeCoding').prepend('<div id="typeCode' + countTypeCoding + '">' + insert + btnRemoveBlock + '</div>')
		$('#typeSystem' + countTypeCoding).focus();
		countTypeCoding++;
	});

	$('#addCoverageArea').click(function(){
		var input = '<input name="coverageArea[]" id="coverageArea' + countCoverageArea +'" type="text" class="form-control" placeholder="Введіть" />';
		var btn = '<div class="input-group-prepend form-group"> <button class="btn btn-danger removeCoverageArea" type = "button" >Видалити</button></div>';
		$('#coverageArea').prepend('<div id="typeCode' + countCoverageArea + '" class="input-group">' + btn + input + '</div>')
		$('#coverageArea' + countCoverageArea).focus();
		countCoverageArea++;
	});

	$('#addAvalibleTime').click(function () {
		var datePikerOption = {
			timeFormat :'HH:mm:ss',
			showSecond: true,
		};

		var dateStart = getInputHtml('avalible' + countAvalibleTime +'Start', 'Початок', 'avalibleStart[]');
		var dateEnd = getInputHtml('avalible' + countAvalibleTime +'End', 'Кінець', 'avalibleEnd[]');
		var checkAllDay = '<div class="form-group"><label for="all_day' + countAvalibleTime +'"> Всі дні </label>'
			+ ' <input type="checkbox" id="all_day' + countAvalibleTime +'" name="all_day[]"></div>';
			                                    
		$('#avalibleTime').prepend('<div id="avalibleTime' + countAvalibleTime + '">' + dayOfWeek + checkAllDay + dateStart + dateEnd + btnRemoveBlock + '</div>');
		$('#avalible' + countAvalibleTime + 'Start').timepicker(datePikerOption);
		$('#avalible' + countAvalibleTime + 'End').timepicker(datePikerOption);
		countAvalibleTime++;
	});


	$('#addNotAvalible').click(function(){
		var datePikerOption = {
			dateFormat: 'yy-mm-dd',
			timeFormat: 'HH:mm:ss',
			showSecond: true,
		};
		var reasonInput = '<div class="form-group">'
			+ '<label for="description' + countNotAvalible +'">Причина недоступності</label>'
			+ '<input type="text" class="form-control" id="description' + countNotAvalible +'" name="description[]" value=""></div>';
		var labelDuring = '<div class="form-group"><label>Протягом</label></div>'
		var dateStart = getInputHtml('during' + countNotAvalible + 'Start', 'Початок', 'duringStart[]');
		var dateEnd = getInputHtml('during' + countNotAvalible + 'End', 'Кінець', 'duringEnd[]');

		$('#notAvalible').prepend('<div id="typeCode' + countNotAvalible + '">' + reasonInput + labelDuring  + dateStart + dateEnd + btnRemoveBlock + '</div>');
		$('#during' + countNotAvalible + 'Start').datetimepicker(datePikerOption);
		$('#during' + countNotAvalible + 'End').datetimepicker(datePikerOption);
		
		countNotAvalible++;
	});
	
	$('#send').click(function(ev){
		ev.preventDefault();

		var data = $('#formCreate').serializeArray();
		var sendData = { 
			category: { coding: [] }, 
		};

		var objCollect = {};
		var name;

		$.each(data, function (i, item) {
			
			if (item.name === '_csrf') sendData._csrf = item.value;
			if (item.name === 'division_id' && item.value.length) sendData.division_id = item.value;
			if (item.name === 'speciality_type' && item.value.length) sendData.speciality_type = item.value;
			if (item.name === 'providing_condition' && item.value.length) sendData.providing_condition = item.value;
			if (item.name === 'license_id' && item.value.length) sendData.license_id = item.value;
			if (item.name === 'categoryText' && item.value.length) sendData.category.text = item.value;
			if (item.name === 'comment' && item.value.length) sendData.comment = item.value;
			if (item.name == 'typeText') {
				if (!sendData.type) sendData.type = {};
				if (item.value.length) sendData.type.text = item.value;
			}

			if (item.name.substr(-2) == '[]' ) {
				name = item.name.substr(0, item.name.length - 2);

				if (name == 'duringEnd') {
					// TODO Need try catch for corrent value and check all values

					objCollect.during.end = (new Date(Date.parse(item.value))).toISOString();
					if (!sendData.not_avalible) sendData.not_avalible = [];

					sendData.not_avalible.push(objCollect);
					objCollect = {};
				}

				if (name == 'duringStart') {
					// TODO Need try catch for corrent value
					objCollect.during = { start: (new Date(Date.parse(item.value))).toISOString() };
				}

				if (name == 'description') {
					objCollect.description = item.value;
				}

				if (name == 'avalibleEnd') {
					if (item.value.length) objCollect.available_end_time = item.value;
					if (!sendData.avalible_time) sendData.avalible_time = [];
					sendData.avalible_time.push(objCollect);
					objCollect = {};
				}

				if (name == 'avalibleStart' && item.value.length) {
					objCollect.available_start_time = item.value;
				}

				if (name == 'all_day') {
					objCollect.all_day = item.value === 'on'
				}

				if (name == 'days_of_week') {
					if (!objCollect.days_of_week) objCollect.days_of_week = [];
					objCollect.days_of_week.push(item.value)
				}

				if (name == 'coverageArea') {
					if (!sendData.caverage_area) sendData.caverage_area = [];
					sendData.caverage_area.push(item.value);
				}

				if (name == 'typeSystem') {
					if (item.value.length) objCollect.system = item.value;
				}
				
				if (name == 'typeCode') {
					if (!sendData.type) sendData.type = {}
					if (!sendData.type.coding) sendData.type.coding = [];
					if (item.value.length) objCollect.code = item.value;
					sendData.type.coding.push(objCollect);
					objCollect = {};
				}

				if (name == 'categorySystem') {
					if(item.value.length) objCollect.system = item.value;
				}

				if (name == 'categoryCode') {
					if (item.value.length)  objCollect.code = item.value;
					sendData.category.coding.push(objCollect);
					objCollect = {};
				}
			}
		});

		console.log(data);
		console.log(sendData);
	});

	function getCheckDayHtml(val, label) {
		return '<label><input type="checkbox" name="days_of_week[]" value="' + val + '"> ' + label + ' </label>'
	};
})
