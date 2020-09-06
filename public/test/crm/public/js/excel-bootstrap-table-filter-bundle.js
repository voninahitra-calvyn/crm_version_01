(function ($$1) {
'use strict';

$$1 = 'default' in $$1 ? $$1['default'] : $$1;

var FilterMenu = function () {
    function FilterMenu(target, th, column, index, options) {
        this.options = options;
        this.th = th;
        this.column = column;
        this.index = index;
        this.tds = target.find('tbody tr td:nth-child(' + (this.column + 1) + ')').toArray();
    }
    FilterMenu.prototype.initialize = function () {
        this.menu = this.dropdownFilterDropdown();
        this.th.appendChild(this.menu);
        var $trigger = $(this.menu.children[0]);
        var $content = $(this.menu.children[1]);
        var $menu = $(this.menu);
        $trigger.click(function () {
            return $content.toggle();
        });
        $(document).click(function (el) {
            if (!$menu.is(el.target) && $menu.has(el.target).length === 0) {
                $content.hide();
            }
        });
    };
    FilterMenu.prototype.searchToggle = function (value) {
        if (this.selectAllCheckbox instanceof HTMLInputElement) this.selectAllCheckbox.checked = false;
        if (value.length === 0) {
            this.toggleAll(true);
            if (this.selectAllCheckbox instanceof HTMLInputElement) this.selectAllCheckbox.checked = true;
            return;
        }
        this.toggleAll(false);
        this.inputs.filter(function (input) {
            return input.value.toLowerCase().indexOf(value.toLowerCase()) > -1;
        }).forEach(function (input) {
            input.checked = true;
        });
    };
    FilterMenu.prototype.searchdateToggle = function (date1) {
		// alert('input alert: '+date1+' date1:'+date1.split("-").reverse().join("/"));
		// var inputDatedebut = new Date('2020/05/04');
		// var inputDatedebut = new Date(date1);
		// var inputDatedebut = new Date(date1.split("-").reverse().join("-"));
		var inputDatedebut = new Date(date1.split("-").reverse().join("/"));
		
        if (this.selectAllCheckbox instanceof HTMLInputElement) this.selectAllCheckbox.checked = false;
        if (date1.length === 0) {
            this.toggleAll(true);
            if (this.selectAllCheckbox instanceof HTMLInputElement) this.selectAllCheckbox.checked = true;
            return;
        }
        this.toggleAll(false);
        this.inputs.filter(function (input) {
			// var dateListeTab = new Date(input.value.toLowerCase().split("-").reverse().join("-"));
			var dateListeTab = new Date(input.value.toLowerCase().split("-").reverse().join("/"));
            // alert('dateListeTab: '+dateListeTab+' date1: '+inputDatedebut);
            // alert('dateListeTab: '+input.value.toLowerCase().split("-").reverse().join("-")+' date1: '+inputDatedebut);
			// return input.value.toLowerCase().split("-").reverse().join("-") <= date1.split("-").reverse().join("-");
			return inputDatedebut <= dateListeTab;
        }).forEach(function (input) {
				// alert('input: '+input.value.toLowerCase().split("-").reverse().join("-")+' date1: '+date1.split("-").reverse().join("-"));
				// alert('input alert: ');
            // alert('2dateListeTab: '+dateListeTab+' 2date1: '+inputDatedebut);
            input.checked = true;
        });
    };
    
    FilterMenu.prototype.searchdatefinToggle = function (date1, date2) {
		var inputDatedebut = new Date(date1.split("-").reverse().join("/"));
		var inputDatefin = new Date(date2.split("-").reverse().join("/"));
		// var inputDatedebut = new Date(date1);
		// var inputDatefin = new Date(date2);
			
        if (this.selectAllCheckbox instanceof HTMLInputElement) this.selectAllCheckbox.checked = false;
        if (date1.length === 0) {
            this.toggleAll(true);
            if (this.selectAllCheckbox instanceof HTMLInputElement) this.selectAllCheckbox.checked = true;
            return;
        }
        this.toggleAll(false);
        this.inputs.filter(function (input) {
			// var dateListeTab = new Date(input.value.toLowerCase().split("-").reverse().join("-"));
			var dateListeTab = new Date(input.value.toLowerCase().split("-").reverse().join("/"));
            return inputDatedebut <= dateListeTab && inputDatefin >= dateListeTab;
        }).forEach(function (input) {
            input.checked = true;
        });
    };
    
	FilterMenu.prototype.updateSelectAll = function () {
        if (this.selectAllCheckbox instanceof HTMLInputElement) {
            $(this.searchFilter).val('');
            $(this.searchdatedbtFilter).val('');
            $(this.searchdatefinFilter).val('');
            this.selectAllCheckbox.checked = this.inputs.length === this.inputs.filter(function (input) {
                return input.checked;
            }).length;
        }
    };
    FilterMenu.prototype.selectAllUpdate = function (checked) {
        $(this.searchFilter).val('');
        $(this.searchdatedbtFilter).val('');
        $(this.searchdatefinFilter).val('');
        this.toggleAll(checked);
    };
    FilterMenu.prototype.toggleAll = function (checked) {
        for (var i = 0; i < this.inputs.length; i++) {
            var input = this.inputs[i];
            if (input instanceof HTMLInputElement) input.checked = checked;
        }
    };
    FilterMenu.prototype.dropdownFilterItem = function (td, self) {
        var value = td.innerText;
        var dropdownFilterItem = document.createElement('div');
        dropdownFilterItem.className = 'dropdown-filter-item';
        var input = document.createElement('input');
        input.type = 'checkbox';
        input.value = value.trim().replace(/ +(?= )/g, '');
        input.setAttribute('checked', 'checked');
        input.className = 'dropdown-filter-menu-item item';
        input.setAttribute('data-column', self.column.toString());
        input.setAttribute('data-index', self.index.toString());
        dropdownFilterItem.appendChild(input);
        dropdownFilterItem.innerHTML = dropdownFilterItem.innerHTML.trim() + ' ' + value;
        return dropdownFilterItem;
    };
    FilterMenu.prototype.dropdownFilterItemSelectAll = function () {
        var value = this.options.captions.select_all;
        var dropdownFilterItemSelectAll = document.createElement('div');
        dropdownFilterItemSelectAll.className = 'dropdown-filter-item';
        var input = document.createElement('input');
        input.type = 'checkbox';
        input.value = this.options.captions.select_all;
        input.setAttribute('checked', 'checked');
        input.className = 'dropdown-filter-menu-item select-all';
        input.setAttribute('data-column', this.column.toString());
        input.setAttribute('data-index', this.index.toString());
        dropdownFilterItemSelectAll.appendChild(input);
        dropdownFilterItemSelectAll.innerHTML = dropdownFilterItemSelectAll.innerHTML + ' ' + value;
        return dropdownFilterItemSelectAll;
    };
    FilterMenu.prototype.dropdownFilterSearch = function () {
        var dropdownFilterItem = document.createElement('div');
        dropdownFilterItem.className = 'dropdown-filter-search';
        var input = document.createElement('input');
        input.type = 'text';
        input.className = 'dropdown-filter-menu-search form-control';
        input.setAttribute('data-column', this.column.toString());
        input.setAttribute('data-index', this.index.toString());
        input.setAttribute('placeholder', this.options.captions.search);
        dropdownFilterItem.appendChild(input);
        return dropdownFilterItem;
    };
    FilterMenu.prototype.dropdownFilterSearchdatedbt = function () {
        var dropdownFilterItem = document.createElement('div');
        dropdownFilterItem.className = 'dropdown-filter-searchdeb';
        var input = document.createElement('input');
        input.id = 'datedebpicker';
        input.name = 'datedebpicker';
        input.type = 'text';
		if (input.type != "date"){ //if browser doesn't support input type="date", initialize date picker widget:
			$(document).ready(function() {
				$('#datedebpicker').datepicker({
					format: 'dd-mm-yyyy',
					weekStart: 1,
					todayHighlight: true,
					todayBtn: true,
					autoclose: true
				});
			}); 
		}
        input.className = 'dropdown-filter-menu-search form-control datedebpicker';
        input.setAttribute('data-column', this.column.toString());
        input.setAttribute('data-index', this.index.toString());
        input.setAttribute('placeholder', this.options.captions.searchdatedbt);
        dropdownFilterItem.appendChild(input);
        dropdownFilterItem.innerHTML = 'Date début: '+dropdownFilterItem.innerHTML;
        return dropdownFilterItem;
    };
	function getDefaultDate(){

		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = (day)+"/"+(month)+"/"+now.getFullYear() ;

		return today;
	};
    FilterMenu.prototype.dropdownFilterSearchdatefin = function () {
        var dropdownFilterItem = document.createElement('div');
        dropdownFilterItem.className = 'dropdown-filter-searchfin';//coco
        var input = document.createElement('input');
        input.id = 'datefinpicker';
        input.name = 'datefinpicker';
        input.type = 'text';
		$(document).ready(function() {
			$('#datefinpicker').datepicker({
				format: 'dd-mm-yyyy',
				weekStart: 1,
				todayHighlight: true,
				todayBtn: true,
				autoclose: true
			});
		}); 
        input.className = 'dropdown-filter-menu-search form-control';
        input.setAttribute('data-column', this.column.toString());
        input.setAttribute('data-index', this.index.toString());
        input.setAttribute('placeholder', this.options.captions.searchdatefin);
        dropdownFilterItem.appendChild(input);
        dropdownFilterItem.innerHTML = 'Date fin: '+dropdownFilterItem.innerHTML;
        return dropdownFilterItem;
    };
    FilterMenu.prototype.dropdownFilterSort = function (direction) {
        var dropdownFilterItem = document.createElement('div');
        dropdownFilterItem.className = 'dropdown-filter-sort';
        var span = document.createElement('span');
        span.className = direction.toLowerCase().split(' ').join('-');
        span.setAttribute('data-column', this.column.toString());
        span.setAttribute('data-index', this.index.toString());
        span.innerText = direction;
        dropdownFilterItem.appendChild(span);
        return dropdownFilterItem;
    };
    FilterMenu.prototype.dropdownFilterContent = function () {
        var _this = this;
        var self = this;
        var dropdownFilterContent = document.createElement('div');
        dropdownFilterContent.className = 'dropdown-filter-content';
        var innerDivs = this.tds.reduce(function (arr, el) {
            var values = arr.map(function (el) {
                return el.innerText.trim();
            });
            if (values.indexOf(el.innerText.trim()) < 0) arr.push(el);
            return arr;
        }, []).sort(function (a, b) {
            var A = a.innerText.toLowerCase();
            var B = b.innerText.toLowerCase();
            if (!isNaN(Number(A)) && !isNaN(Number(B))) {
                if (Number(A) < Number(B)) return -1;
                if (Number(A) > Number(B)) return 1;
            } else {
                if (A < B) return -1;
                if (A > B) return 1;
            }
            return 0;
        }).map(function (td) {
            return _this.dropdownFilterItem(td, self);
        });
        this.inputs = innerDivs.map(function (div) {
            return div.firstElementChild;
        });
        var selectAllCheckboxDiv = this.dropdownFilterItemSelectAll();
        this.selectAllCheckbox = selectAllCheckboxDiv.firstElementChild;
        innerDivs.unshift(selectAllCheckboxDiv);
        var searchFilterDiv = this.dropdownFilterSearch();
        this.searchFilter = searchFilterDiv.firstElementChild;
        var searchdatedbtFilterDiv = this.dropdownFilterSearchdatedbt();
        this.searchdatedbtFilter = searchdatedbtFilterDiv.firstElementChild;
        var searchdatefinFilterDiv = this.dropdownFilterSearchdatefin();
        this.searchdatefinFilter = searchdatefinFilterDiv.firstElementChild;
        var outerDiv = innerDivs.reduce(function (outerDiv, innerDiv) {
            outerDiv.appendChild(innerDiv);
            return outerDiv;
        }, document.createElement('div'));
        outerDiv.className = 'checkbox-container';
        var elements = [];
        if (this.options.sort) elements = elements.concat([this.dropdownFilterSort(this.options.captions.a_to_z), this.dropdownFilterSort(this.options.captions.z_to_a)]);
        if (this.options.search) elements.push(searchFilterDiv);
        if (this.options.searchdatedbt) elements.push(searchdatedbtFilterDiv);
        if (this.options.searchdatefin) elements.push(searchdatefinFilterDiv);
        return elements.concat(outerDiv).reduce(function (html, el) {
            html.appendChild(el);
            return html;
        }, dropdownFilterContent);
    };
    FilterMenu.prototype.dropdownFilterDropdown = function () {
        var dropdownFilterDropdown = document.createElement('div');
        dropdownFilterDropdown.className = 'dropdown-filter-dropdown';
        var arrow = document.createElement('span');
        arrow.className = 'glyphicon glyphicon-arrow-down dropdown-filter-icon';
        var icon = document.createElement('i');
        icon.className = 'arrow-down';
        arrow.appendChild(icon);
        dropdownFilterDropdown.appendChild(arrow);
        dropdownFilterDropdown.appendChild(this.dropdownFilterContent());
        if ($(this.th).hasClass('no-sort')) {
            $(dropdownFilterDropdown).find('.dropdown-filter-sort').remove();
        }
        if ($(this.th).hasClass('no-filter')) {
            $(dropdownFilterDropdown).find('.checkbox-container').remove();
        }
        if ($(this.th).hasClass('no-search')) {
            $(dropdownFilterDropdown).find('.dropdown-filter-search').remove();
        }
        if ($(this.th).hasClass('date')==false) {
            $(dropdownFilterDropdown).find('.dropdown-filter-searchdeb').remove();
            $(dropdownFilterDropdown).find('.dropdown-filter-searchfin').remove();
        }
        return dropdownFilterDropdown;
    };
    return FilterMenu;
}();

var FilterCollection = function () {
    function FilterCollection(target, options) {
        this.target = target;
        this.options = options;
        this.ths = target.find('th' + options.columnSelector).toArray();
        this.filterMenus = this.ths.map(function (th, index) {
            var column = $(th).index();
            return new FilterMenu(target, th, column, index, options);
        });
        this.rows = target.find('tbody').find('tr').toArray();
        this.table = target.get(0);
    }
    FilterCollection.prototype.initialize = function () {
        this.filterMenus.forEach(function (filterMenu) {
            filterMenu.initialize();
        });
        this.bindCheckboxes();
        this.bindSelectAllCheckboxes();
        this.bindSort();
        this.bindSearch();
        this.bindSearchdate();
    };
    FilterCollection.prototype.bindCheckboxes = function () {
        var filterMenus = this.filterMenus;
        var rows = this.rows;
        var ths = this.ths;
        var updateRowVisibility = this.updateRowVisibility;
        this.target.find('.dropdown-filter-menu-item.item').change(function () {
            var index = $(this).data('index');
            var value = $(this).val();
            filterMenus[index].updateSelectAll();
            updateRowVisibility(filterMenus, rows, ths);
        });
    };
    FilterCollection.prototype.bindSelectAllCheckboxes = function () {
        var filterMenus = this.filterMenus;
        var rows = this.rows;
        var ths = this.ths;
        var updateRowVisibility = this.updateRowVisibility;
        this.target.find('.dropdown-filter-menu-item.select-all').change(function () {
            var index = $(this).data('index');
            var value = this.checked;
            filterMenus[index].selectAllUpdate(value);
            updateRowVisibility(filterMenus, rows, ths);
        });
    };
    FilterCollection.prototype.bindSort = function () {
        var filterMenus = this.filterMenus;
        var rows = this.rows;
        var ths = this.ths;
        var sort = this.sort;
        var table = this.table;
        var options = this.options;
        var updateRowVisibility = this.updateRowVisibility;
        this.target.find('.dropdown-filter-sort').click(function () {
            var $sortElement = $(this).find('span');
            var column = $sortElement.data('column');
            var order = $sortElement.attr('class');
            sort(column, order, table, options);
            updateRowVisibility(filterMenus, rows, ths);
        });
    };
    FilterCollection.prototype.bindSearch = function () {
        var filterMenus = this.filterMenus;
        var rows = this.rows;
        var ths = this.ths;
        var updateRowVisibility = this.updateRowVisibility;
        this.target.find('.dropdown-filter-search').keyup(function () {
            var $input = $(this).find('input');
            var index = $input.data('index');
            var value = $input.val();
			// alert('value: '+value);
            filterMenus[index].searchToggle(value);
            updateRowVisibility(filterMenus, rows, ths);
        });
    };
    FilterCollection.prototype.bindSearchdate = function () {
        var filterMenus = this.filterMenus;
        var rows = this.rows;
        var ths = this.ths;
		var date1 = null;
        var updateRowVisibility = this.updateRowVisibility;
		
        this.target.find('.dropdown-filter-searchdeb').change(function () {
            var $input = $(this).find('input');
            var index = $input.data('index');
            date1 = $input.val();
            filterMenus[index].searchdateToggle(date1);
            updateRowVisibility(filterMenus, rows, ths);
        });

        this.target.find('.dropdown-filter-searchfin').change(function () {
			var $input = $(this).find('input');
			if(date1==null){
				alert('Veuillez séléctionner la date de début s\'il vous plait');
				$input.val(null);
			}else{
				var index = $input.data('index');
				var date2 = $input.val();
				filterMenus[index].searchdatefinToggle(date1, date2);
				updateRowVisibility(filterMenus, rows, ths);
			}
        });
    };
    FilterCollection.prototype.updateRowVisibility = function (filterMenus, rows, ths) {
        var showRows = rows;
        var hideRows = [];
        var selectedLists = filterMenus.map(function (filterMenu) {
            return {
                column: filterMenu.column,
                selected: filterMenu.inputs.filter(function (input) {
                    return input.checked;
                }).map(function (input) {
                    return input.value.trim().replace(/ +(?= )/g, '');
                })
            };
        });
        for (var i = 0; i < rows.length; i++) {
            var tds = rows[i].children;
            for (var j = 0; j < selectedLists.length; j++) {
                var content = tds[selectedLists[j].column].innerText.trim().replace(/ +(?= )/g, '');
                if (selectedLists[j].selected.indexOf(content) === -1) {
                    $(rows[i]).hide();
                    break;
                }
                $(rows[i]).show();
            }
        }
    };
    /*FilterCollection.prototype.sort = function (column, order, table, options) {
        var flip = 1;
        if (order === options.captions.z_to_a.toLowerCase().split(' ').join('-')) flip = -1;
        var tbody = $(table).find('tbody').get(0);
        var rows = $(tbody).find('tr').get();
        rows.sort(function (a, b) {
            var A = a.children[column].innerText.toUpperCase();
            var B = b.children[column].innerText.toUpperCase();
            if (!isNaN(Number(A)) && !isNaN(Number(B))) {
                if (Number(A) < Number(B)) return -1 * flip;
                if (Number(A) > Number(B)) return 1 * flip;
            } else {
                if (A < B) return -1 * flip;
                if (A > B) return 1 * flip;
            }
            return 0;
        });
        for (var i = 0; i < rows.length; i++) {
            tbody.appendChild(rows[i]);
        }
    };*/
	
	FilterCollection.prototype.sort = function(column, order, table, options) {
		var flip = 1;
		if (order === options.captions.z_to_a.toLowerCase().split(' ').join('-')) flip = -1;
		var tbody = $(table).find('tbody').get(0);
		var rows = $(tbody).find('tr').get();
		var th = $(table).find('th')[column];
		var isType = th.getAttribute('istype');
		var dateformat = th.getAttribute('dateformat');
		rows.sort(function(a, b) {
			var A = a.children[column].innerText.toUpperCase();
			var B = b.children[column].innerText.toUpperCase();
			if (isType == 'date') {
				A = moment(A, dateformat);
				B = moment(B, dateformat);
				return A.diff(B, 'd') * flip;
			} else if (!isNaN(Number(A)) && !isNaN(Number(B))) {
				if (Number(A) < Number(B)) return -1 * flip;
				if (Number(A) > Number(B)) return 1 * flip;
			} else {
				if (A < B) return -1 * flip;
				if (A > B) return 1 * flip;
			}
			return 0;
		});
		for (var i = 0; i < rows.length; i++) {
			tbody.appendChild(rows[i]);
		}
	};
	
    return FilterCollection;
}();

$$1.fn.excelTableFilter = function (options) {
    var target = this;
    options = $$1.extend({}, $$1.fn.excelTableFilter.options, options);
    if (typeof options.columnSelector === 'undefined') options.columnSelector = '';
    if (typeof options.sort === 'undefined') options.sort = true;
    if (typeof options.search === 'undefined') options.search = true;
    if (typeof options.searchdatedbt === 'undefined') options.searchdatedbt = true;
    if (typeof options.searchdatefin === 'undefined') options.searchdatefin = true;
    if (typeof options.captions === 'undefined') options.captions = {
        a_to_z: 'A à Z',
        z_to_a: 'Z à A',
        searchdatedbt: 'date début',
        searchdatefin: 'date fin',
        search: 'Recherche',
        select_all: 'Séléctionner tous'
    };
    var filterCollection = new FilterCollection(target, options);
    filterCollection.initialize();
    return target;
};
$$1.fn.excelTableFilter.options = {};

}(jQuery));
//# sourceMappingURL=excel-bootstrap-table-filter-bundle.js.map
