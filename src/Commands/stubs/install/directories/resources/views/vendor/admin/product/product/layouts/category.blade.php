<div class="table-responsive ">
    <table class="table table-tree" id="categories">
        @if($trees)
            <tbody >
        		@foreach($trees as $value)
                    <tr>
                        <td class="text-left">
                            <div class="block checkbox">
                                <label>
                                    @if($categories && in_array($value['id'], $categories))
                                        <input name="categories[]" value="{{ $value['id'] }}" type="checkbox" checked="checked">
                                    @else
                                        <input name="categories[]" value="{{ $value['id'] }}" type="checkbox" >
                                    @endif
                                    {{ $value['title'] }}
                                </label>
                            </div>
                            @if($value['childrens'])
                                @include('admin::media.media.layouts.categoryPiece',['trees'=>$value['childrens']])
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endif
        <tfoot >
            <tr>
                <td class="text-right">
                    <ul class="list-inline">
                        <li><a href="javascript:;" onclick="$('input[name^=categories]').prop('checked', true);" >@Lang('admin::media.text.checked_all')</a></li>
                        <li>/<li>
                        <li><a href="javascript:;" onclick="$('input[name^=categories]').prop('checked', false);" >@Lang('admin::media.text.checked_none')</a></li>
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $('input[name^=categories]').on('click',function(){
        var checked = $(this).is(':checked');
        $(this).parents('tr').each(function(){
            if(checked){
                $(this).find('.checkbox:first').find('input[name^=categories]').prop('checked', checked);
            }
        });
        $(this).parents('tr:first').find('tr').each(function(){
            if(!checked){
                $(this).find('.checkbox').find('input[name^=categories]').prop('checked', checked);
            }
        }); 
    });
</script>