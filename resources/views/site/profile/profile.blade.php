@extends('site.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 text-left">
            <div class="card">
                <div class="card-header" style="background:#275879;color:#ffffff;">
                    <span>معلومات المستخدم</span>
                </div>
                <div class="card-body">

                    @if (session()->has('success'))
                        <h6 class="alert alert-success">{{ session('success') }}</h6>
                    @endif
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        <div class="form-group ">

                            <label>الاسم</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="form-group ">

                            <label>البريد الإلكتروني</label>
                            <input type="email" readonly value="{{ $user->email }}" class="form-control">

                        </div>

                        <div class="form-group ">

                            <label>كلمة المرور</label>
                            <input type="password" name="password"
                                placeholder="اترك الحقل فارغ في حال لم ترغب بتغيير كلمة المرور" class="form-control">

                        </div>
                        <div class="form-group ">
                            <label>تأكيد كلمة المرور</label>
                            <input type="password" name="c_password"
                                placeholder="اترك الحقل فارغ في حال لم ترغب بتغيير كلمة المرور" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-block btn-secondary" style="background:#65aeca;"><i
                                    class="fa fa-save"></i> حفظ التعديلات
                            </button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="p-2 mt-2">
                <a class="btn btn-sm btn-block btn-secondary" style="background:#65aeca;"
                    href="{{ route('msg.all') }}">المراسلات
                    @if ($count > 0)
                        <kbd>{{ $count }}</kbd>
                    @endif
                </a>
            </div>
        </div>
        <div class="col-md-8  text-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background:#275879;color:#ffffff;">
                        <span>إعلاناتك</span> <span>{{ $user->posts->count() }}/إعلان </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>عنوان الإعلان</th>
                                <th>وصف الإعلان</th>
                                <th>التحكم</th>
                            </tr>
                            @php
                                $posts = $user->posts()->paginate();
                            @endphp
                            @foreach ($posts as $post)
                                <tr>
                                    <td><a href="{{ route('post.show', ['id' => $post->id]) }}">{{ $post->title }}</a></td>
                                    <td>{{ \Illuminate\Support\Str::substr($post->description, 0, 45) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('post.edit', ['id' => $post->id]) }}"><i class="fa fa-edit"></i>
                                            تعديل</a>
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('post.delete', ['id' => $post->id]) }}"><i
                                                class="fa fa-trash"></i>
                                            حذف</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>


                    <div class="card-footer">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5 text-left">
                <div class="card">
                    <div class="card-header" style="background:#275879;color:#ffffff;">
                        <span>الإعلانات المفضلة</span>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>العنوان</th>
                                <th>صاحب الإعلان</th>
                                <th>حذف</th>
                            </tr>
                            @if (auth()->user()->favorit->count() > 0)

                                @foreach (auth()->user()->favorit as $p)
                                    <tr>
                                        <td><a
                                                href="{{ route('post.show', ['id' => $p->post_id]) }}">{{ $p->post->title }}</a>
                                        </td>
                                        <td>{{ $p->user->name }}</td>
                                        <td><a href="{{ route('fav.delete', ['id' => $p->id]) }}"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>

                    <div class="card-footer"></div>

                </div>
            </div>

        </div>

    </div>
@stop
