/**
 * Created by greatroad on 16/11/5.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function addChildCate(currentNode) {
    if( $(currentNode).parent().find('input').val()=='' ){
        $(currentNode).parent().find('input').focus();
        $(currentNode).parent().append('<span class="text-danger">子菜单不能能空</span>');
    }else{
        $.ajax({
            type:'post',
            url:'/users/'+$('#user-card').data('user-id')+'/child_categories',
            data:{parent_id:currentNode.parents('li').attr('data-category-id'),name:currentNode.parent().find('input').val()},
            dataType:'json',
            success:function (data) {
                currentNode.parent().next().append(
                    '<li class="child-cate-list" data-child-category-id="'+data.id+'">'+
                    data.name+''+
                    '<span><i class="fa fa-times" aria-hidden="true"></i></span>'+
                    '</li>'
                );
                currentNode.parent().find('input').val('');
            }
        });
    }
};
$()

$(document).ready(function(){
    $('#commentForm textarea').keydown(function(e) {
        if ((e.ctrlKey||e.metaKey) && e.keyCode == 13) {
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
        if($('#addProfession').find('input').val()==''){
            $('#addProfession').append('<span class="text-danger">请添加专业名称</span>');
        }else{
            $.ajax({
                type:'post',
                url:'/users/'+$('#wrap-id').data('user-id')+'/professions',
                data:{name:$('#addProfession').find('input').val()},
                success:function (data) {
                    $('#profession-table tbody').append(`
                    <tr>
                        <td>New</td>
                        <td>${ data.profession.name }</td>
                        <td>
                            <button class="btn btn-danger" data-profession-id="${data.profession.id}">删除</button>
                        </td>
                    </tr>`);
                    $('#addProfession').find('input').val('');
                }
            })
        }


    });
    //删除职业
    $('#profession-table').delegate('button','click',function () {
        var that = $(this);
       $.ajax({
           type:'delete',
           url:'/users/'+$('#wrap-id').data('user-id')+'/professions/'+$('#profession-table button').attr('data-profession-id'),
           success:function (data) {
               that.parent().parent().remove();
           }
       });
    });

    $('.delete-article').click(function () {
        var current_article = $(this);
        if(confirm('确认删除该文章吗？')){
            $.ajax({
                type:'delete',
                url:'/users/'+$('#user-card').data('user-id')+'/articles/'+$(this).parent().parent().attr('data-article-id'),
                success:function (data) {
                    if(data.status=='0'){
                        current_article.parent().parent().fadeOut();
                    }
                }
            });
        }
    });

    $('.removeProfession').click(function () {
        var currentNode = $(this);
       var professionId =  currentNode.parent().data('profession-id');
        $.ajax({
           type:'delete',
            url:'/professions/'+professionId,
            success:function (data) {
                currentNode.parent().fadeOut();
            }
        });
    })

    $('#add-category').click(function () {
        if($(this).prev().find('input').val()==''){
            $(this).prev().find('input').focus().end()
                .parent().append('<span class="text-danger">主菜单名称不能为空</span>');
        }else{
           var current_cate= $(this);
            $.ajax({
                type:'post',
                url:'/users/'+$('#user-card').data('user-id')+'/categories',
                data:{parent_id:0,name:$(this).prev().find('input').val()},
                dataType:'json',
                success:function (data) {
                    $('#category_list').append(
                        '<hr>'+
                        '<li data-category-id="'+data.id+'">'+
                        data.name+'<span  class="delete-category-btn"><i class="fa fa-times" aria-hidden="true"></i></span>'+
                        '<fieldset class="form-inline">'+
                        '<div class="form-group">'+
                        '<div class="input-group">'+
                        '<input class="form-control" placeholder="添加子菜单" required="required" name="category" type="text">'+
                        '<div class="input-group-addon">'+'<i class="fa fa-check-square-o" aria-hidden="true">'+'</i>'+'</div>'+
                        '</div>'+
                        '</div>'+''+
                        ' <button class="btn btn-info" onclick="addChildCate($(this))">添加子菜单</button>'+
                        '</fieldset>'+'<ul></ul>'+
                        '</li>'
                    );
                    current_cate.prev().find('input').val('');
                }
            });

        };
    });



    // $('.child-cate-btn').click(function () {
    //    if( $(this).parent().find('input').val()=='' ){
    //        $(this).parent().find('input').focus();
    //        $(this).parent().append('<span class="text-danger">子菜单不能能空</span>');
    //    }else{
    //        var current_node = $(this);
    //         $.ajax({
    //            type:'post',
    //            url:'/users/'+$('#user-card').data('user-id')+'/categories',
    //            data:{parent_id:$(this).parents('li').attr('data-category-id'),name:$(this).parent().find('input').val()},
    //             dataType:'json',
    //             success:function (data) {
    //                 console.log(current_node);
    //                 current_node.parent().next().append(
    //                     '<li class="child-cate-list" data-child-category-id="'+data.id+'">'+
    //                         data.name+''+
    //                         '<span><i class="fa fa-times" aria-hidden="true"></i></span>'+
    //                     '</li>'
    //                 );
    //                 current_node.parent().find('input').val('');
    //             }
    //         });
    //    }
    // });

    $('#commentBtn').click(function(){
        $.ajax({
           type:'post',
            url:'/comments',
            dataType:'json',
            data:{article_id:$('#article').data('article-id'),content:$('#markdown').val(),parent_id:0},
            success:function(data){
                $('#commentList').append(
                    '<div class="meida">'+
                        '<a href="" class="media-left">'+
                            '<img src="'+$('#imgUrl').attr('src')+'" alt="" width="80" height="80">'+
                        '</a>'+
                        '<div class="media-body" data-comment-id="'+data.commentId+'">'+
                            '<h6 class="media-heading">'+$('#userName').text()+'<small>'+ data.createdAt+' #'+ data.floor +'</small>'+'</h6>'+
                                data.content+
                            '<div class="text-xs-right">'+
                                '<button class="btn btn-outline-info reply">'+'回复'+'</button>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+'<hr>');
                $('#markdown').val('');
            }
        });
    });
    //启动模态框
    $('.reply').click(function () {
        var commentId = $(this).parent().parent().attr('data-comment-id');
        $('#myModal').attr('data-parent-id',commentId);
        $('#myModal').modal('show');
    });
    $('.replyBtn').click(function(){
        var content = $(this).parent().prev().find('textarea').val();
        $.ajax({
           type:'post',
            url:'/comments',
            dataType:'json',
            data:{article_id:$('#article').data('article-id'),content:content,parent_id:$('#myModal').attr('data-parent-id')},
            success:function(data){
                $('#commentList').append(
                    '<div class="meida">'+
                    '<a href="" class="media-left">'+
                    '<img src="'+$('#imgUrl').attr('src')+'" alt="" width="80" height="80">'+
                    '</a>'+
                    '<div class="media-body" data-comment-id="'+data.commentId+'">'+
                    '<h6 class="media-heading">'+$('#userName').text()+'<small>'+ data.createdAt+ '</small>'+'</h6>'+
                    data.content+
                    '<div class="text-xs-right">'+
                    '<button class="btn btn-outline-info reply">'+'回复'+'</button>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+'<hr>');
                $('#myModal').modal('hide').find('textarea').val('');
            }
        });
    });


    $('#support').click(function(){
       $.ajax({
          type:'post',
           url:'/articles/'+$('#article').data('article-id')+'/support',
           dataType:'json',
           success:function (data) {
               $('#supportCount').text(data.supportCount);
           }
       });
    });
    $('#unsupport').click(function(){
        $.ajax({
            type:'post',
            url:'/articles/'+$('#article').data('article-id')+'/unsupport',
            dataType:'json',
            success:function (data) {
                $('#unsupportCount').text(data.unsupportCount);
            }
        });
    });

    $('#likeable').click(function(){
        if($('#likeable').attr('data-likeable-id')=='0'){
            $.ajax({
               type:'post',
                url:'/likeables',
                dataType:'json',
                data:{article_id:$('#article').data('article-id')},
                success:function(data){
                    $('#likeable').toggleClass('fa-heart-o fa-heart')
                        .attr('data-likeable-id',data.likeableId);
                        $('#likeCount').text(data.likeCount);

                }
            });
        }else{
            $.ajax({
                type:'delete',
                url:'/likeables/'+$('#likeable').attr('data-likeable-id'),
                dataType:'json',
                data:{likeable_id:$('#likeable').attr('data-likeable-id'),article_id:$('#article').data('article-id'),_method:'delete'},
                success:function(data){
                    $('#likeable').toggleClass('fa-heart-o fa-heart')
                        .attr('data-likeable-id',0);
                        $('#likeCount').text(data.likeCount);
                }
            })
        }
    });

    $('#collect').click(function () {
        if($('#collect').attr('data-collect-id')=='0')
        {
            $.ajax({
                type:'post',
                url:'/collects',
                dataType:'json',
                data:{article_id:$('#article').data('article-id')},
                success: function (data) {
                    $('#collect').removeClass('btn-default')
                        .addClass('btn-danger')
                        .attr('data-collect-id', data.data.id);
                    $('#collect>span').text(' 已收藏');
                }
            });
        }else
        {
            $.ajax({
                type:'delete',
                url:'/collects/'+$('#collect').attr('data-collect-id'),
                dataType:'json',
                data:{article_id:$('#article').data('article-id'),_method:'delete'},
                success: function (data) {
                    $('#collect').addClass('btn-default')
                        .removeClass('btn-danger')
                        .attr('data-collect-id',0);
                    $('#collect>span').text(' 收藏');
                }
            });
        }

    });
});
