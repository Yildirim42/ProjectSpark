<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spark • <?= $user->full_name; ?></title>
    
    <link rel="icon" href="data:,">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc; 
        }
        .nav-glass { 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px); 
        }
        .profile-gradient { 
            background: linear-gradient(to top right, #06b6d4, #2563eb); 
        }
    </style>
</head>
<body class="text-slate-800">

    <nav class="sticky top-0 z-50 nav-glass border-b border-slate-200 shadow-sm">
        <div class="max-w-3xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="<?= site_url('feed'); ?>" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-cyan-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.704l2.036-7.308H3.75a.75.75 0 01-.548-1.262L13.702 1.683a.75.75 0 01.913-.088z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-900">Spark</span>
            </a>

            <div class="flex items-center gap-4">
                <a href="<?= site_url('feed'); ?>" class="text-sm font-semibold text-blue-600 hover:text-cyan-600 transition-colors">Akışa Dön</a>
                <a href="<?= site_url('auth/logout'); ?>" class="w-9 h-9 flex items-center justify-center rounded-full bg-slate-100 text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all" title="Çıkış Yap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-xl mx-auto px-4 py-6">

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="h-32 profile-gradient"></div>
            <div class="px-6 pb-6">
                <div class="relative flex justify-between items-end -mt-12 mb-4">
                    <div class="relative group">
                        <img src="<?= base_url('uploads/profiles/' . $user->profile_pic); ?>" 
                             class="w-24 h-24 rounded-2xl border-4 border-white object-cover shadow-md bg-white"
                             onerror="this.onerror=null; this.src='<?= base_url('uploads/profiles/default_avatar.png'); ?>';">
                        
                        <?php if ($is_mine): ?>
                            <label for="profile_image" class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-2xl opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-white">
                                    <path d="M12 9a3.75 3.75 0 100 7.5A3.75 3.75 0 0012 9z" />
                                    <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 015.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.627 1.11.651 1.172.059 2.319.224 3.421.487.854.204 1.459.953 1.459 1.832v10.43c0 .879-.605 1.628-1.46 1.832a48.813 48.813 0 01-19.331 0C1.605 20.232 1 19.483 1 18.604V8.174c0-.879.605-1.628 1.46-1.832a48.57 48.57 0 013.421-.487c.465-.024.87-.268 1.11-.651l.82-1.317c.501-.805 1.365-1.338 2.332-1.39zM6.75 12.75a5.25 5.25 0 1110.5 0 5.25 5.25 0 01-10.5 0zm12-1.5a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                </svg>
                            </label>
                            <form action="<?= site_url('profile/update_photo'); ?>" method="POST" enctype="multipart/form-data" id="photoForm" class="hidden">
                                <input type="file" name="profile_image" id="profile_image" onchange="document.getElementById('photoForm').submit()">
                            </form>
                        <?php endif; ?>
                    </div>

                    <?php if ($is_mine): ?>
                        
                    <?php endif; ?>
                </div>

                <div>
                    <h1 class="text-xl font-bold text-slate-900"><?= $user->full_name; ?></h1>
                    <p class="text-slate-500 text-sm font-medium italic">@<?= $user->username; ?></p>
                </div>

                <?php if($this->session->flashdata('success')): ?>
                    <div class="mt-4 bg-emerald-50 text-emerald-600 text-xs p-3 rounded-xl border border-emerald-100 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-emerald-500">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.74-5.24z" clip-rule="evenodd" />
                        </svg>
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 ml-1">
            <?= $is_mine ? 'Paylaşımlarım' : $user->full_name . ' Gönderileri'; ?>
        </h3>

        <div class="space-y-6">
            <?php if (empty($posts)): ?>
                <div class="text-center py-12 bg-white rounded-3xl border border-slate-200 border-dashed">
                    <p class="text-slate-400 text-sm font-medium">Bu kullanıcı henüz bir paylaşım yapmadı.</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-4 flex gap-3 items-start">
                            <div class="flex-shrink-0">
                                <img src="<?= base_url('uploads/profiles/' . $post->profile_pic); ?>" 
                                     class="w-10 h-10 rounded-full object-cover shadow-sm"
                                     onerror="this.onerror=null; this.src='<?= base_url('uploads/profiles/default_avatar.png'); ?>';">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h6 class="font-bold text-slate-900"><?= $post->full_name; ?></h6>
                                    <span class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-full"><?= date('d M H:i', strtotime($post->created_at)); ?></span>
                                </div>
                                <p class="text-slate-700 mt-2 text-sm leading-relaxed"><?= $post->content; ?></p>
                            </div>
                        </div>

                        <?php if (!empty($post->media_path) && $post->media_type != 'text'): ?>
                            <div class="mx-4 mb-4 rounded-2xl overflow-hidden border border-slate-100">
                                <?php if ($post->media_type == 'image'): ?>
                                    <img src="<?= base_url('uploads/posts/' . $post->media_path); ?>" class="w-full h-auto object-cover max-h-96">
                                <?php elseif ($post->media_type == 'video'): ?>
                                    <video controls class="w-full max-h-96 bg-black">
                                        <source src="<?= base_url('uploads/posts/' . $post->media_path); ?>" type="video/mp4">
                                    </video>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </main>

    <div class="h-12"></div>
</body>
</html>