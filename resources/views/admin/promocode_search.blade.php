<?php foreach($data as $k=>$v) $$k=$v;  ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/promocode.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Promocode</h3>
                    <div class="input-group input-group-sm">
                        <input type="search" name="promocode" id="promocode" class="form-control" placeholder="Input
                        the Promocode"/>
                        <span class="input-group-btn">
                          <button class="btn btn-info btn-flat" name="filter_btn" id="filter_btn" type="button"
                                  onclick="filtercontent();">Search PromoCode!</button>
                        </span>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Promocode</th>
                        <th>Client</th>
                        <th>valid_from</th>
                        <th>valid_to</th>
                        <th>active</th>
                        <th>date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($acList as $content)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $content->promocode }}</td>
                            <td>{{ $content->id_used_by }}</td>
                            <td>@if (empty($content->valid_from)) <p>-</p> @else {{ $content->valid_from }}
                                @endif</td>
                            <td>@if (empty($content->valid_to)) <p>-</p> @else {{ $content->valid_to }}
                                @endif</td>
                            <td>{{ $content->active }}</td>
                            <td>{{ $content->date }}</td>
                          </tr>
                    @endforeach
                    </tbody>
                </table>
                </div><!-- /.box-body -->
            </div><!-- /.row (box) -->
        </div><!-- /.row (col) -->
    </div><!-- /.row (main row) -->
@endsection