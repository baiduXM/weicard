/**
 * Created by Hsieh on 2017/4/7.
 */
$(function () {
    /* 添加 */
    $('.operate-add').click(function () {
        var _url = $(this).data('url');
        location.href = _url;
    });

    /* 全选checkbox */
    $('#btSelectAll').click(function () {
        if (this.checked) {
            $(".selectall-item").prop("checked", true);
        } else {
            $(".selectall-item").prop("checked", false);
        }
    });

    /* 单选 */
    $('.selectall-item').click(function () {
        var length = $('.selectall-item').length;
        var select_length = $('.selectall-item:checked').length;
        if (length == select_length) {
            $('#btSelectAll').prop('checked', true);
        } else {
            $('#btSelectAll').prop('checked', false);
        }
    });

    /* 删除 */
    $('.operate-delete').click(function () {
        $('#confirmModal').on('show.bs.modal', function (event) {
            var relatedTarget = $(event.relatedTarget);
            var _id = relatedTarget.data('id');
            var _url = relatedTarget.data('url');
            var modal = $(this);
            modal.find('.modal-title').text('删除确认');
            modal.find('.modal-body').text('是否删除' + _id + '用户？');
            modal.find('form').attr('action', _url);
            modal.find('[name="_method"]').val('DELETE');
        });
    });

    /* 批量删除 */
    $(".operate-batch-delete").click(function () {
        var length = $('.selectall-item:checked').length;
        var _url = $(this).data('url');
        if (length == 0) {
            alert('未选择');
            return false;
        } else {
            var ids_arr = new Array;
            $('.selectall-item:checked').each(function () {
                ids_arr.push($(this).val());
            });
            var ids_str = ids_arr.join(',');
            $('#confirmModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                modal.find('.modal-title').text('删除确认');
                modal.find('.modal-body').text('是否删除' + ids_str + '用户？');
                modal.find('form').attr('action', _url);
                modal.find('[name="_method"]').val('DELETE');
                modal.find('form').append('<input type="hidden" name="ids" value="' + ids_str + '"/>');
            });
        }
    });

    /* 搜索 */
    $('.operate-search').click(function () {
        $('[name="form_search"]').submit();
    });

    /* 搜索下拉框 */
    $('.dropdown-item').click(function () {
        console.log($(this).text());
        var column = $(this).data('column');
        var txt = $(this).text() + ' <span class="caret"></span>';
        $('[name="search_column"]').html(txt);
        $('[name="column"]').val(column);
    });

    /* 排序 */
    $('.sortable').click(function () {
        var _this = $(this);
        var _chidren = $(this).children('.order');
        if (_this.hasClass('color-orange')) {
            _chidren.toggleClass('dropup');
        } else {
            $('.sortable').removeClass('color-orange');
            _this.addClass('color-orange');
        }
        var _column = _this.data('name');
        var _form = $('[name="form_search"]');
        var _sort = 'desc';
        if (_chidren.hasClass('dropup')) { // 正序
            _sort = 'asc';
        } else { // 倒序
            _sort = 'desc';
        }
        _form.append('<input type="hidden" name="sort_column" value="' + _column + '"/>');
        _form.append('<input type="hidden" name="sort_way" value="' + _sort + '"/>');
        _form.submit();
    });

    /* 刷新 */
    $('.operate-refresh').click(function () {
        var _url = $(this).data('url');
        location.href = _url;
    });


    /* 初始化 */
    function init() {
        // 搜索初始值
        var column = getQueryString('column');
        var keyword = getQueryString('keyword');
        column = (column != null) ? column : 'name';
        keyword = (keyword != null) ? decodeURIComponent(keyword) : '';
        var txt = $('[name="column_' + column + '"]').text() + ' <span class="caret"></span>';
        $('[name="search_column"]').html(txt);
        $('[name="column"]').val(column);
        $('[name="keyword"]').val(keyword);
        // 排序初始值
        var sort_column = getQueryString('sort_column');
        var sort_way = getQueryString('sort_way');
        if (sort_column != null) {
            var _column = $('[data-name="' + sort_column + '"]');
            _column.addClass('color-orange');
            if (sort_way != null && sort_way == 'asc') {
                _column.children('.order').addClass('dropup');
            }
        }
    }

    /* 获取url参数 */
    function getQueryString(name) {
        var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return (r[2]);
        }
        return null;
    }

    /* 运行 */
    init();


});