<!-- =============================================================== -->
<!-- 💬 قسم التعليقات والإعجابات (Comments & Likes Section) -->
<!-- =============================================================== -->
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4 p-md-5">

            <h4 class="fw-bold mb-4">💬 التعليقات ({{ $post->comments->count() }})</h4>

            <!-- 1. رسائل النجاح (Alerts) -->
            @if(session('success'))
            <div class="alert alert-success text-center fw-semibold py-2 border-0 shadow-sm rounded-3">
                ✅ {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger text-center fw-semibold py-2 border-0 shadow-sm rounded-3">
                ⚠️ {{ $errors->first() }}
            </div>
            @endif

            <!-- 2. فورم إضافة تعليق جديد -->
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-5">
                @csrf
                <div class="mb-3">
                    <textarea name="body" class="form-control rounded-3 @error('body') is-invalid @enderror"
                        rows="3" placeholder="اكتب تعليقك هنا يا {{ auth()->user()->name }}..." required>{{ old('body') }}</textarea>
                </div>
                <button type="submit" class="btn btn-dark px-4 fw-semibold rounded-3">إرسال التعليق ➔</button>
            </form>

            <hr class="my-4 text-muted">

            <!-- 3. قائمة التعليقات السابقة -->
            <div class="comments-list">
                @forelse($post->comments as $comment)
                <div class="card mb-3 border bg-light rounded-3 shadow-sm">
                    <div class="card-body p-3 p-md-4">

                        <!-- رأس التعليق: اسم اليوزر والوقت -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-primary mb-0">
                                👤 {{ $comment->user->name }}
                            </h6>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>

                        <!-- نص التعليق الأساسي -->
                        <p class="card-text text-dark mb-3" style="line-height: 1.7;">
                            {{ $comment->body }}
                        </p>

                        <!-- أزرار التفاعل (لايك - تعديل - حذف) -->
                        <div class="d-flex align-items-center gap-2 flex-wrap">

                            <!-- زرار اللايك (Toggle Like) -->
                            <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $comment->isLikedByAuthUser() ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-3">
                                    {{ $comment->isLikedByAuthUser() ? '❤️ معجب' : '🤍 إعجاب' }}
                                    <span class="badge bg-white text-danger ms-1">{{ $comment->likes->count() }}</span>
                                </button>
                            </form>

                            <!-- حماية: أزرار التعديل والحذف تظهر بس لصاحب التعليق! -->
                            @if($comment->user_id === auth()->id())

                            <!-- زرار يفتح فورم التعديل (Bootstrap Collapse) بدون جافاسكريبت -->
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                type="button" data-bs-toggle="collapse" data-bs-target="#edit-comment-{{ $comment->id }}">
                                ✏️ تعديل
                            </button>

                            <!-- زرار الحذف -->
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="m-0"
                                onsubmit="return confirm('هل أنت متأكد من حذف هذا التعليق؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    🗑️ حذف
                                </button>
                            </form>

                            @endif

                        </div>

                        <!-- 4. فورم التعديل المخفي (بيظهر لما تدوس على زرار تعديل) -->
                        @if($comment->user_id === auth()->id())
                        <div class="collapse mt-3" id="edit-comment-{{ $comment->id }}">
                            <div class="card card-body border-0 bg-white shadow-sm rounded-3 p-3">
                                <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <textarea name="body" class="form-control form-control-sm rounded-3" rows="2" required>{{ $comment->body }}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#edit-comment-{{ $comment->id }}">إلغاء</button>
                                        <button type="submit" class="btn btn-sm btn-success px-3 fw-semibold">حفظ التعديلات</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                @empty
                <!-- لو مفيش تعليقات خالص -->
                <div class="text-center py-5 text-muted">
                    <h5>📭 لا توجد تعليقات حتى الآن..</h5>
                    <p class="mb-0">كن أول من يشارك برأيه في هذا المقال!</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>