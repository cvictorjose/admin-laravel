@extends('admin.app')
@section('header')
    <h1>
        Terms & Conditions List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Terms & Conditions </li>
        <li class="active">Terms & Conditions List</li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Terms & Conditions</h3>
                    <a href="{{ URL::to('admin/termsadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-file-text-o"></i> Add new Terms
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($apList as $content)
                        <?php $i++; $filter_lang="en";?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $content->title }}</td>
                            <td><a class="moredesc" onclick="openpopup({{ $content->term_id }}, '{{ $filter_lang }}');" style="cursor: pointer;">...More...</a>
                                <div class="contenttooltip{{ $content->term_id }}{{ $filter_lang }}"  style="display: none;">
                                    <?php echo html_entity_decode(mb_convert_encoding($content->description, 'HTML-ENTITIES', 'UTF-8'));  ?>
                                </div>
                            </td>
                            <td><a href="{{ URL::to('admin/editterms') }}/{{ $content->term_id }}"><i class="fa
                            fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div><!-- /.box-body -->
            </div><!-- /.row (box) -->
        </div><!-- /.row (col) -->
    </div><!-- /.row (main row) -->
    <script type="text/javascript">
        $(function () {
            $("#example1").dataTable();
        });

        function openpopup(cid, lang){
            $('.contenttooltip'+cid+lang).css("width", "800px");
            $('.contenttooltip'+cid+lang).css("height", "500px");
            $('.contenttooltip'+cid+lang).css("background-color", "#fff");
            $('.contenttooltip'+cid+lang).css("border", "1px solid black");
            $('.contenttooltip'+cid+lang).css("overflow", "auto");
            $('.contenttooltip'+cid+lang).css("padding", "10px");
            $('.contenttooltip'+cid+lang).bPopup({
                follow: [false, false], //x, y
                position: [150, 100], //x, y
                speed: 150,
                transition: "slideIn",
                modalColor: "#DDDDDD",
                amsl:0,
            });
        }
    </script>

@endsection