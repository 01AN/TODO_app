
<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>Todo</title>

</head>
 
<body class="flex flex-col min-h-[100vh]">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl">Todoアプリ</p>
            </div>
        </div>
    </header>

    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <p class="text-2xl font-bold text-center">今日は何する？</p>
                <form action="/tasks" method="post" class="mt-10">
                  @csrf
 
                  <div class="flex flex-col items-center">
                    <label class="w-full max-w-3xl mx-auto">
                        <input
                            class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                            placeholder="洗濯物をする..." type="text" name="task_name" />
                            @error('task_name')
                            <div class="mt-3">
                                <p class="text-ted-500"> 
                                    {{ $message }}
                                </p>
                            </div>
                            @enderror
                    </label>

                    <select name="category_name" class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                        <option value="仕事">仕事</option>
                        <option value="趣味">趣味</option>
                        <option value="その他">その他</option>
                    </select>
 
                    <button type="submit" class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                        追加する
                    </button>
                  </div>

                </form>
                @if ($tasks->isNotEmpty())
      <div>
          <div>
              <div>
                  <div>
                      タイトル
                  </div>
                  <div>
                      カテゴリー
                  </div>
              </div>
              <div class=filter_item>
                  @foreach ($tasks as $item)
                  <div class=item>
                      <div>
                          {{ $item->name }}
                  </div>
                  <div  data-item="{{ $item->category}}">
                      {{ $item->category}}
                  </div>
                  <div>
                      <form action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="status" value="{{$item->status}}"></input>
                          <button type="submit">完了</button>
                      </form>
                  </div>
                  <div>
                      <a href="/tasks/{{ $item->id }}/edit/">編集</a>
                  </div>
                  <div>
                      <form onsubmit="return deleteTask();" action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                      @csrf
                      @method('DELETE')
                      <button type="submit">削除</button>
                      </form>
                  </div>
                  </div>
                  @endforeach
                  <div class="clear"></div>
              </div>
          </div>
      </div>
  @endif
  <table>
                      <thead>
                          <tr>
                              <th scope="col">
                                  カテゴリー選択
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>
                                  <input id="IDwork" type="button" value="仕事" onclick="selectCAT(this)">
                                  <input id="IDhobby" type="button" value="趣味" onclick="selectCAT(this)">
                                  <input id="IDother" type="button" value="その他" onclick="selectCAT(this)">
                              </td>
                          </tr>
                      </tbody>
                  </table>
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

<script>
    let filter_item;
    let tasks = []
    window.onload=function(){
        
        filter_item = document.getElementsByClassName("filter_item");
        for (let item of filter_item) {
            console.log(item.cells[0].innerText)
            console.log( item.cells[1].innerText)
            tasks.push({name: item.cells[0].innerText, category: item.cells[1].innerText})
        }

        
        console.log(tasks)
    }

    function deleteTask(){
        if (confirm('本当に削除しますか？')){
            return true;
        }else{
            return false;
        }
    }
    
    function selectCAT(element){
        let category = element.value
        for (let item of tasks){
            if(category == item.category){
                console.log(filter_item)
                filter_item.item(0).appendChild(`<td class="item-name">
                                      <div>
                                          {{ $item->name }}
                                      </div>
                                  </td>
                                  <td class="category=name">
                                      <div  data-item="{{ $item->category}}">
                                          {{ $item->category}}
                                      </div>
                                  </td>
                                  <td>
                                      <div>
                                          <form action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                               @csrf
                                               @method('PUT')
                                               <input type="hidden" name="status" value="{{$item->status}}"></input>
                                               <button type="submit">完了</button>
                                          </form>
                                      </div>
                                  </td>
                                  <td>
                                      <div>
                                          <a href="/tasks/{{ $item->id }}/edit/">編集</a>
                                      </div>
                                  </td>
                                  <td>
                                      <div>
                                          <form onsubmit="return deleteTask();" action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit">削除</button>
                                              </form>
                                      </div>
                                  </td>`)
            }
        }
    }

    // let itemname = ["洗濯","買い物","ゲーム"]
    // let itemcategory = ["仕事","その他","仕事"]

    // let task = {
    //     name: "",
    //     cate: ""
    // }
</script>

</html>


