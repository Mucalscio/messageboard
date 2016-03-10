@extends('layouts.app')

@section('content')


    <div class="panel-body">

        <form action="message" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="message" class="col-sm-3 control-label">留言</label>

                <div class="col-sm-6">
                    <input type="text" name="message" id="message" class="form-control">
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> 确定
                    </button>
                </div>
            </div>
        </form>

        @if (count($messages) > 0)
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Messages
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Messages</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td class="table-text"><div>{{ $message->message }}</div></td>

                                    <!-- Task Delete Button -->
                                    <td style="text-align:right;">
                                        <form action="message/{{ $message->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>删除
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

@endsection