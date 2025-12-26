<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spark • Akış</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        /* Scrollbar iyileştirmesi */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="text-slate-800">

    <nav class="sticky top-0 z-50 nav-glass border-b border-slate-200 shadow-sm">
        <div class="max-w-3xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="<?= site_url('feed'); ?>" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-cyan-200/50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 0 1 .359.852L12.982 9.75h7.268a.75.75 0 0 1 .548 1.262l-10.5 11.25a.75.75 0 0 1-1.272-.71l1.992-7.302H3.75a.75.75 0 0 1-.548-1.262l10.5-11.25a.75.75 0 0 1 .913-.143Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-900">Spark</span>
            </a>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex flex-col items-end leading-tight">
                    <span class="text-xs text-slate-500 font-medium">Hoş geldin,</span>
                    <span class="text-sm font-bold text-slate-800">
                        <a href="<?= site_url('profile'); ?>" class="hover:text-cyan-600 transition-colors">
                            @<?= $this->session->userdata('username'); ?>
                        </a>
                    </span>
                </div>
                <a href="<?= site_url('auth/logout'); ?>" class="w-9 h-9 flex items-center justify-center rounded-full bg-slate-100 text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors" title="Çıkış Yap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-xl mx-auto px-4 py-6">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 mb-8">
            <h5 class="text-sm font-semibold text-slate-500 mb-3 ml-1">Yeni Gönderi</h5>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="bg-red-50 text-red-600 text-sm p-3 rounded-xl mb-3 border border-red-100">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('feed/create_post'); ?>" method="POST" enctype="multipart/form-data">
                <div class="relative">
                    <textarea name="content" rows="3"
                        class="w-full bg-slate-50 border-0 rounded-xl p-3 text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-cyan-500/30 focus:bg-white transition-all resize-none text-base"
                        placeholder="Bugün neler oluyor?" required></textarea>
                </div>

                <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                    <div class="flex items-center">
                        <label class="cursor-pointer flex items-center gap-2 text-slate-500 hover:text-cyan-600 transition-colors py-1 px-2 rounded-lg hover:bg-cyan-50">
                            <span id="iconContainer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6" id="imageIcon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 hidden text-cyan-500" id="checkIcon">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.74-5.24Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="text-sm font-medium" id="fileName">Medya Ekle</span>
                            <input type="file" name="userfile" id="postImage" class="hidden" onchange="updateFileName(this)">
                        </label>
                    </div>

                    <button type="submit" class="bg-gradient-to-tr from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-2 rounded-xl font-semibold text-sm shadow-lg shadow-cyan-200/50 transition-all transform active:scale-95 flex items-center gap-2">
                        Paylaş
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-6">

            <?php if (empty($posts)): ?>
                <div class="text-center py-10 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                    </div>
                    <h3 class="text-slate-800 font-semibold">Henüz hiç gönderi yok</h3>
                    <p class="text-slate-500 text-sm mt-1">İlk paylaşımı yapan sen ol!</p>
                </div>
            <?php else: ?>

                <?php foreach ($posts as $post): ?>
                    <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="p-4 flex gap-3 items-start">
                            <div class="flex-shrink-0">
                                <img src="<?= base_url('uploads/profiles/' . $post->profile_pic); ?>"
                                    class="w-10 h-10 rounded-full bg-slate-200 object-cover border border-slate-100"
                                    onerror="this.onerror=null; this.src='<?= base_url('uploads/profiles/default_avatar.png'); ?>';">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h6 class="font-bold text-slate-900 truncate">
                                            <a href="<?= site_url('profile/index/' . $post->username); ?>" class="hover:text-blue-600 transition-colors">
                                                <?= $post->full_name; ?>
                                            </a>
                                        </h6>
                                        <p class="text-xs text-slate-500">@<?= $post->username; ?></p>
                                    </div>
                                    <span class="text-xs text-slate-400"><?= date('d M H:i', strtotime($post->created_at)); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 pb-2">
                            <p class="text-slate-700 whitespace-pre-line leading-relaxed"><?= $post->content; ?></p>
                        </div>

                        <?php if (!empty($post->media_path) && $post->media_type != 'text'): ?>
                            <div class="mt-2">
                                <?php if ($post->media_type == 'image'): ?>
                                    <img src="<?= base_url('uploads/posts/' . $post->media_path); ?>"
                                        class="w-full h-auto object-cover max-h-[500px] border-y border-slate-100 bg-slate-50"
                                        alt="Post Görseli">
                                <?php elseif ($post->media_type == 'video'): ?>
                                    <div class="w-full bg-black">
                                        <video controls class="w-full max-h-[500px]" preload="metadata">
                                            <source src="<?= base_url('uploads/posts/' . $post->media_path); ?>" type="video/mp4">
                                        </video>
                                    </div>
                                    <div class="px-4 py-2 bg-slate-50 border-b border-slate-100 text-center">
                                        <a href="<?= base_url('uploads/posts/' . $post->media_path); ?>" target="_blank" class="text-xs text-cyan-600 hover:underline flex items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                            </svg>
                                            Videoyu Yeni Sekmede Aç
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <div class="text-center mt-12 mb-6 text-slate-400 text-xs">
            &copy; 2025 Spark Inc. Tüm hakları saklıdır.
        </div>

    </main>

    <script>
        function updateFileName(input) {
            const fileNameSpan = document.getElementById('fileName');
            const imageIcon = document.getElementById('imageIcon');
            const checkIcon = document.getElementById('checkIcon');

            if (input.files && input.files.length > 0) {
                let name = input.files[0].name;
                if (name.length > 20) name = name.substring(0, 18) + '...';

                fileNameSpan.textContent = name;
                fileNameSpan.classList.add('text-cyan-600');

                imageIcon.classList.add('hidden');
                checkIcon.classList.remove('hidden');
            } else {
                fileNameSpan.textContent = 'Medya Ekle';
                fileNameSpan.classList.remove('text-cyan-600');

                imageIcon.classList.remove('hidden');
                checkIcon.classList.add('hidden');
            }
        }
    </script>
</body>

</html>