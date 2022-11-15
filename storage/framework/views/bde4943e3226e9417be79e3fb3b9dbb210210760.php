<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
</head>
 
<body class="flex flex-col min-h-[100vh]">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl">完了リスト</p>
            </div>
        </div>
    </header>
 
    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
            <?php if($tasks->isNotEmpty()): ?>
      <div class="max-w-7xl mx-auto mt-20">
          <div class="inline-block min-w-full py-2 align-middle">
              <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                  <table border="1" style="border-collapse: collapse">
                      <thead class="bg-gray-50">
                          <tr>
                              <th scope="col">
                                  完了済みタスク
                              </th>
                              <th scope="col">
                                  カテゴリー
                              </th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 bg-white">
                          <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                  <td class="px-3 py-4 text-sm text-gray-500">
                                      <div>
                                          <?php echo e($item->name); ?>

                                      </div>
                                  </td>
                                  <td class="px-3 py-4 text-sm text-gray-500">
                                      <div>
                                          <?php echo e($item->category); ?>

                                      </div>
                                  </td>
                                  <td class="p-0 text-right text-sm font-medium">
                                      <div class="flex justify-end">
                                          <div>
                                              <form action="/history/<?php echo e($item->id); ?>"
                                                  method="post"
                                                  class="inline-block text-gray-500 font-medium"
                                                  role="menuitem" tabindex="-1">
                                                  <?php echo csrf_field(); ?>
                                                  <?php echo method_field('PUT'); ?>
                                                  <input type="hidden" name="status" value="<?php echo e($item->status); ?>">
                                                  <button type="submit"
                                                      class="bg-emerald-700 py-4 w-20 text-white md:hover:bg-emerald-800 transition-colors">戻す</button>
                                              </form>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  <?php endif; ?>
                
            </div>
        </div>
    </main>
    <footer class="bg-slate-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="py-4 text-center">
            <p class="text-white text-sm">Todoアプリ</p>
        </div>
    </div>
    </footer>
</body>
 
</html><?php /**PATH C:\Users\CRE\Documents\todo_app\resources\views/history/index.blade.php ENDPATH**/ ?>