

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $.cookie('XSRF-TOKEN')
    }
});
//删除一级菜单
$('#category_list').delegate('.delete-category-btn', 'click', function () {
    var that = $(this);

    $.ajax({
        type: 'delete',
        url: '/admin/categories/' + that.parent().attr('data-category-id'),
        dataType: 'json',
        success: function success(data) {
            that.parent().remove();
        }
    });
});

$('#category_list').delegate('.child-category-btn', 'click', function () {
    var that = $(this);
    if (that.prev().find('input').val() == '') {
        that.prev().find('input').focus();
        that.next().text('子菜单名称不能为空');
    } else {
        $.ajax({
            type: 'post',
            url: '/admin/child_categories',
            data: { category_id: that.parent().parent().attr('data-category-id'), name: that.prev().find('input').val() },
            dataType: 'json',
            success: function success(data) {
                that.parent().next().append('<li data-child-category-id="' + data.child_category.id + '">\n                    ' + data.child_category.name + ' \n                    <span class="delete-child-category-btn">\n                        <i class="fa fa-times" aria-hidden="true"></i>\n                    </span>\n                  </li>');
                that.prev().find('input').val('');
            }
        });
    }
});

$('#category_list').delegate('.delete-child-category-btn', 'click', function () {
    var that = $(this);
    $.ajax({
        type: 'delete',
        url: '/admin/child_categories/' + that.parent().attr('data-child-category-id'),
        dataType: 'json',
        success: function success(data) {
            that.parent().remove();
        }
    });
});

$(document).ready(function () {
    $('#commentForm textarea').keydown(function (e) {
        if ((e.ctrlKey || e.metaKey) && e.keyCode == 13) {
            $("#commentBtn").click();
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addProfession').find('button').click(function () {

        var currentNode = $(this);
        if ($('#addProfession').find('input').val() == '') {
            $('#addProfession').append('<span class="text-danger">请添加专业名称</span>');
        } else {
            $.ajax({
                type: 'post',
                url: '/admin/professions',
                data: { name: $('#addProfession').find('input').val() },
                success: function success(data) {
                    $('#profession-table tbody').append('\n                    <tr>\n                        <td>New</td>\n                        <td>' + data.profession.name + '</td>\n                        <td>\n                            <button class="btn btn-danger" data-profession-id="' + data.profession.id + '">\u5220\u9664</button>\n                        </td>\n                    </tr>');
                    $('#addProfession').find('input').val('');
                }
            });
        }
    });
    //删除职业
    $('#profession-table').delegate('button', 'click', function () {
        var that = $(this);
        $.ajax({
            type: 'delete',
            url: '/admin/professions/' + that.attr('data-profession-id'),
            success: function success(data) {
                that.parent().parent().remove();
            }
        });
    });

    $('.delete-article-btn').click(function () {
        var current_article = $(this);
        if (confirm('确认删除该文章吗？')) {
            $.ajax({
                type: 'delete',
                url: '/admin/articles/' + $(this).parent().parent().data('article-id'),
                success: function success(data) {
                    if (data.status == '0') {
                        current_article.parent().parent().fadeOut();
                    }
                }
            });
        }
    });

    $('.removeProfession').click(function () {
        var currentNode = $(this);
        var professionId = currentNode.parent().data('profession-id');
        $.ajax({
            type: 'delete',
            url: '/professions/' + professionId,
            success: function success(data) {
                currentNode.parent().fadeOut();
            }
        });
    });

    $('#add-category').click(function () {
        if ($(this).prev().find('input').val() == '') {
            $(this).prev().find('input').focus();
            $(this).next().text('主菜单名称不能为空！');
        } else {
            var current_cate = $(this);
            $.ajax({
                type: 'post',
                url: '/admin/categories',
                data: { parent_id: 0, name: $(this).prev().find('input').val() },
                dataType: 'json',
                success: function success(data) {
                    $('#category_list').append('<hr>' + '<li data-category-id="' + data.id + '">' + data.name + '<span class="delete-category-btn"><i class="fa fa-times" aria-hidden="true"></i></span>' + '<fieldset class="form-inline">' + '<div class="form-group">' + '<div class="input-group">' + '<input class="form-control" placeholder="添加子菜单" required="required" name="category" type="text">' + '<div class="input-group-addon">' + '<i class="fa fa-check-square-o" aria-hidden="true">' + '</i>' + '</div>' + '</div>' + '</div>' + '' + ' <button class="btn btn-info child-category-btn">添加子菜单</button><span class="text-danger"></span>' + '</fieldset>' + '<ul></ul>' + '</li>');
                    current_cate.prev().find('input').val('');
                }
            });
        }
        ;
    });

    $('#commentBtn').click(function () {
        $.ajax({
            type: 'post',
            url: '/comments',
            dataType: 'json',
            data: { article_id: $('#article').data('article-id'), content: $('#markdown').val(), parent_id: 0 },
            success: function success(data) {
                $('#commentList').append('\n                        <div class="meida">\n                            <a href="" class="media-left">\n                                <img src="' + $('#imgUrl').attr('src') + '" alt="" width="80" height="80">\n                            </a>\n                            <div class="media-body" data-comment-id="' + data.commentId + '">\n                                <h6 class="media-heading">\n                                <span class="user-name">' + $('#userName').text() + '</span>\n                                 <small>' + data.createdAt + ' #' + data.floor + '</small></h6>\n                                <p>' + data.content + '</p>\n                        \n                                <div class="text-right"><button class="btn btn-info reply">\u56DE\u590D</button></div>\n                            </div>\n                        </div>\n                        <hr>\n                ');
                $('#markdown').val('');
            }
        });
    });
    //启动模态框
    $('.reply').click(function () {
        var replyUserName = $(this).parent().parent().find('.user-name').text();
        var commentId = $(this).parent().parent().attr('data-comment-id');
        $('#myModal').attr('data-parent-id', commentId);
        $('#myModal').modal('show');
        $('#myModal').find('textarea').val('\u56DE\u590D' + replyUserName + ':');
    });
    $('.replyBtn').click(function () {
        var content = $(this).parent().prev().find('textarea').val();
        $.ajax({
            type: 'post',
            url: '/comments',
            dataType: 'json',
            data: {
                article_id: $('#article').data('article-id'),
                content: content,
                parent_id: $('#myModal').attr('data-parent-id')
            },
            success: function success(data) {
                $('#commentList').append('<div class="meida">\n            <a href="" class="media-left">\n                <img src="' + $('#imgUrl').attr('src') + '" width="80" height="80">\n            </a>\n        <div class="media-body" data-comment-id="' + data.commentId + '">\n            <h6 class="media-heading"><span class="user-name">' + $('#userName').text() + '</span> <small>' + data.createAt + '</small></h6>\n            ' + data.content + '\n    \n            <div class="text-right">\n              <button class="btn btn-info reply">\u56DE\u590D</button>\n            </div>\n        </div>\n    </div>');
                $('#myModal').modal('hide').find('textarea').val('');
            }
        });
    });

    $('#support').click(function () {
        $.ajax({
            type: 'post',
            url: '/articles/' + $('#article').data('article-id') + '/support',
            dataType: 'json',
            success: function success(data) {
                $('#supportCount').text(data.supportCount);
            }
        });
    });
    $('#unsupport').click(function () {
        $.ajax({
            type: 'post',
            url: '/articles/' + $('#article').data('article-id') + '/unsupport',
            dataType: 'json',
            success: function success(data) {
                $('#unsupportCount').text(data.unsupportCount);
            }
        });
    });

    $('#likeable').click(function () {
        if ($('#likeable').attr('data-likeable-id') == '0') {
            $.ajax({
                type: 'post',
                url: '/likeables',
                dataType: 'json',
                data: { article_id: $('#article').data('article-id') },
                success: function success(data) {
                    $('#likeable').toggleClass('fa-heart-o fa-heart').attr('data-likeable-id', data.likeableId);
                    $('#likeCount').text(data.likeCount);
                }
            });
        } else {
            $.ajax({
                type: 'delete',
                url: '/likeables/' + $('#likeable').attr('data-likeable-id'),
                dataType: 'json',
                data: {
                    likeable_id: $('#likeable').attr('data-likeable-id'),
                    article_id: $('#article').data('article-id'),
                    _method: 'delete'
                },
                success: function success(data) {
                    $('#likeable').toggleClass('fa-heart-o fa-heart').attr('data-likeable-id', 0);
                    $('#likeCount').text(data.likeCount);
                }
            });
        }
    });

    $('#collect').click(function () {
        if ($('#collect').attr('data-collect-id') == '0') {
            $.ajax({
                type: 'post',
                url: '/collects',
                dataType: 'json',
                data: { article_id: $('#article').data('article-id') },
                success: function success(data) {
                    $('#collect').removeClass('btn-default').addClass('btn-danger').attr('data-collect-id', data.data.id);
                    $('#collect>span').text(' 已收藏');
                }
            });
        } else {
            $.ajax({
                type: 'delete',
                url: '/collects/' + $('#collect').attr('data-collect-id'),
                dataType: 'json',
                data: { article_id: $('#article').data('article-id'), _method: 'delete' },
                success: function success(data) {
                    $('#collect').addClass('btn-default').removeClass('btn-danger').attr('data-collect-id', 0);
                    $('#collect>span').text(' 收藏');
                }
            });
        }
    });
});



//# sourceMappingURL=application.js.map
