<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ColoCare 食物查詢</title>
<style>
  :root {
    --bg: #f3f6f7; --surface: #ffffff; --ink: #14272d; --muted: #5d7077; --line: #d9e1e4;
    --green: #2e9e5b; --yellow: #e0a512; --red: #d64545; --accent: #1f5f6b;
  }
  @media (prefers-color-scheme: dark) {
    :root { --bg: #0f1a1e; --surface: #17262b; --ink: #e7eff1; --muted: #93a8af; --line: #284047; --accent: #6fc0cf; }
  }
  * { box-sizing: border-box; }
  body { margin: 0; background: var(--bg); color: var(--ink);
    font-family: "Noto Sans TC", "PingFang TC", "Microsoft JhengHei", sans-serif; line-height: 1.6; }
  main { max-width: 760px; margin: 0 auto; padding: 40px 20px 64px; }
  h1 { font-size: 1.9rem; margin: 0 0 4px; letter-spacing: .02em; }
  .sub { color: var(--muted); margin: 0 0 24px; }
  .search { display: flex; gap: 8px; margin-bottom: 16px; }
  input { flex: 1; font: inherit; padding: 12px 14px; border: 1px solid var(--line); border-radius: 8px;
    background: var(--surface); color: var(--ink); }
  input:focus-visible, button:focus-visible { outline: 3px solid var(--accent); outline-offset: 2px; }
  button { font: inherit; padding: 12px 20px; border: 0; border-radius: 8px; background: var(--accent); color: var(--bg); cursor: pointer; }
  .legend { display: flex; flex-wrap: wrap; gap: 16px; margin: 0 0 20px; color: var(--muted); font-size: .9rem; }
  .dot { display: inline-block; width: 12px; height: 12px; border-radius: 50%; margin-right: 6px; vertical-align: -1px; }
  .g { background: var(--green); } .y { background: var(--yellow); } .r { background: var(--red); }
  ul { list-style: none; margin: 0; padding: 0; border: 1px solid var(--line); border-radius: 10px; background: var(--surface); }
  li { display: flex; align-items: center; gap: 14px; padding: 14px 18px; border-bottom: 1px solid var(--line); }
  li:last-child { border-bottom: 0; }
  li .dot { width: 18px; height: 18px; margin: 0; flex: none; }
  .name { font-size: 1.05rem; font-weight: 600; }
  .tag { margin-left: auto; color: var(--muted); font-size: .85rem; text-align: right; }
  .state { padding: 28px 18px; color: var(--muted); text-align: center; }
</style>
</head>
<body>
<main>
  <h1>ColoCare 食物查詢</h1>
  <p class="sub">輸入食物名稱，查看產氣程度的紅黃綠燈。</p>

  <div class="search">
    <input id="keyword" type="search" placeholder="例如：地瓜" aria-label="食物關鍵字">
    <button id="go">查詢</button>
  </div>

  <p class="legend">
    <span><i class="dot g"></i>綠燈：少量產氣</span>
    <span><i class="dot y"></i>黃燈：中量產氣</span>
    <span><i class="dot r"></i>紅燈：多量產氣</span>
  </p>

  <ul id="list"></ul>
</main>

<script>
  // 放在 Laravel 的 public/ 資料夾，網址同源，所以用相對路徑即可
  const API = '/api/foods';
  const LEVELS = [
    { cls: 'g', text: '少量產氣' },
    { cls: 'y', text: '中量產氣' },
    { cls: 'r', text: '多量產氣' },
  ];
  const list = document.getElementById('list');
  const input = document.getElementById('keyword');

  function show(message) {
    list.innerHTML = '';
    const li = document.createElement('li');
    li.className = 'state';
    li.textContent = message;
    list.appendChild(li);
  }

  function render(items) {
    if (!items.length) return show('找不到符合的食物，換個關鍵字試試。');
    list.innerHTML = '';
    for (const item of items) {
      const level = LEVELS[Number(item.gas_label)] || LEVELS[0];
      const li = document.createElement('li');

      const dot = document.createElement('i');
      dot.className = 'dot ' + level.cls;

      const name = document.createElement('span');
      name.className = 'name';
      name.textContent = item.food_name;

      const tag = document.createElement('span');
      tag.className = 'tag';
      const parts = [level.text];
      tag.textContent = parts.join('，');

      li.append(dot, name, tag);
      list.appendChild(li);
    }
  }

  async function load() {
    show('載入中…');
    try {
      const res = await fetch(API + '?keyword=' + encodeURIComponent(input.value.trim()));
      if (!res.ok) throw new Error('HTTP ' + res.status);
      const json = await res.json();
      render(Array.isArray(json) ? json : (json.data || []));
    } catch (e) {
      show('無法取得資料（' + e.message + '），請確認 Laravel 伺服器有啟動。');
    }
  }

  document.getElementById('go').addEventListener('click', load);
  input.addEventListener('keydown', e => { if (e.key === 'Enter') load(); });
  load();
</script>
</body>
</html>
