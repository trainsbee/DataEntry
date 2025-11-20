<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Laberinto - Juego para Mercadito</title>
  <style>
    :root{--bg:#0f172a; --card:#0b1220; --accent:#22c55e; --muted:#9aa6b2; --panel:#081025;}
    html,body{height:100%;margin:0;font-family:Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:linear-gradient(180deg,#071028 0%, #071126 100%); color:#e6eef6}
    .app{max-width:1100px;margin:20px auto;padding:18px;display:grid;grid-template-columns:1fr 360px;gap:18px}
    .card{background:linear-gradient(180deg,rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border-radius:12px;padding:14px;box-shadow:0 6px 20px rgba(2,6,23,0.6)}
    header h1{margin:0;font-size:20px}
    .game-area{display:flex;flex-direction:column;gap:12px}
    .canvas-wrap{background:linear-gradient(180deg,#031028,#05203a);padding:12px;border-radius:8px;display:flex;justify-content:center;align-items:center}
    canvas{background:#071B2A;border-radius:6px;display:block}
    .controls{display:flex;gap:8px;flex-wrap:wrap}
    button{background:var(--accent);border:none;padding:8px 12px;border-radius:8px;color:#052219;font-weight:600;cursor:pointer}
    .muted{color:var(--muted);font-size:13px}
    .panel{display:flex;flex-direction:column;gap:12px}
    .stat{display:flex;justify-content:space-between;align-items:center;padding:10px;background:rgba(255,255,255,0.02);border-radius:8px}
    .small{font-size:13px}
    .prizes{display:grid;grid-template-columns:1fr;gap:8px}
    .prize{padding:8px;border-radius:8px;background:linear-gradient(90deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));}
    .log{height:120px;overflow:auto;padding:8px;background:rgba(0,0,0,0.15);border-radius:8px;font-size:13px}
    footer{grid-column:1/-1;text-align:center;color:var(--muted);font-size:13px;margin-top:8px}
    @media(max-width:950px){.app{grid-template-columns:1fr;padding:12px}.panel{order:2}}
  </style>
</head>
<body>
  <div class="app">
    <div class="card">
      <header style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
        <div>
          <h1>Laberinto - Mercadito</h1>
          <div class="muted">Paga para jugar. Premios según qué tan lejos llegues.</div>
        </div>
      </header>

      <div class="game-area">
        <div class="canvas-wrap">
          <canvas id="mazeCanvas" width="720" height="480"></canvas>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center">
          <div class="controls">
            <button class="time-btn" data-time="30" data-cost="5">5 L — 30s</button>
            <button class="time-btn" data-time="60" data-cost="10">10 L — 1min</button>
            <button class="time-btn" data-time="120" data-cost="15">15 L — 2min</button>
            <button class="time-btn" data-time="180" data-cost="20">20 L — 3min</button>
            <div class="muted small" style="align-self:center">Usa teclas ↑ ↓ ← → para moverte</div>
          </div>

          <div class="muted small">Créditos: <strong id="credits">20</strong></div>
        </div>

        <div style="display:flex;gap:12px;align-items:center">
          <div class="stat" style="flex:1">
            <div>
              <div class="small muted">Tiempo restante</div>
              <div id="timerDisplay">0s</div>
            </div>
          </div>

          <div class="stat" style="flex:1">
            <div>
              <div class="small muted">Progreso</div>
              <div id="progressText">0%</div>
            </div>
            <div style="min-width:140px;text-align:right">
              <div class="small muted">Intentos restantes</div>
              <div id="attempts">1</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <aside class="panel card">
      <h3>Panel de control</h3>
      <div class="small muted">Premios según progreso</div>
      <div class="prizes" id="prizeList">
        <div class="prize"><strong>10%</strong> — Confite</div>
        <div class="prize"><strong>30%</strong> — Churro</div>
        <div class="prize"><strong>50%</strong> — Jugo pequeño</div>
        <div class="prize"><strong>100%</strong> — Producto sorpresa</div>
      </div>
      <div class="log" id="log"></div>
    </aside>

    <footer class="muted small">Hecho para mercaditos — modifica premios y precios en el panel. Pruébalo en un navegador moderno.</footer>
  </div>

  <script>
    (function(){
      const canvas = document.getElementById('mazeCanvas');
      const ctx = canvas.getContext('2d');
      const BASE_COLS = 12, BASE_ROWS = 8;
      const cellW = Math.floor(canvas.width / BASE_COLS), cellH = Math.floor(canvas.height / BASE_ROWS);

      let maze = [], player = {c:0,r:0}, goal = {c:0,r:0};
      let visited = new Set(), timer = null, timeLeft = 0, credits = 20, gameActive = false;
      let initialDistance = 0;
      let COLS=BASE_COLS, ROWS=BASE_ROWS;

      function idx(c,r){return r*COLS + c;}

      function generateMaze(difficulty){
        COLS = BASE_COLS + difficulty; ROWS = BASE_ROWS + difficulty;
        goal = {c:COLS-1, r:ROWS-1};
        maze = Array.from({length:ROWS}, ()=> Array.from({length:COLS}, ()=> ({walls:[1,1,1,1],visited:false}))); 
        let stack=[];
        maze[0][0].visited=true; stack.push({r:0,c:0});
        while(stack.length){
          const {r,c}=stack[stack.length-1];
          const neighbors=[];
          const dirs=[[-1,0,0,2],[0,1,1,3],[1,0,2,0],[0,-1,3,1]];
          for(const [dr,dc,twall,owall] of dirs){
            const nr=r+dr, nc=c+dc;
            if(nr>=0 && nr<ROWS && nc>=0 && nc<COLS && !maze[nr][nc].visited) neighbors.push({nr,nc,twall,owall});
          }
          if(neighbors.length){
            const pick=neighbors[Math.floor(Math.random()*neighbors.length)];
            maze[r][c].walls[pick.twall]=0;
            maze[pick.nr][pick.nc].walls[pick.owall]=0;
            maze[pick.nr][pick.nc].visited=true;
            stack.push({r:pick.nr,c:pick.nc});
          } else stack.pop();
        }
        for(let rr=0;rr<ROWS;rr++) for(let cc=0;cc<COLS;cc++) maze[rr][cc].visited=false;
      }

      function resetPlayer(){
        player={c:0,r:0}; visited=new Set(); visited.add(idx(player.c,player.r)); updateUI();
      }

      function draw(){
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.strokeStyle='#123a4a'; ctx.lineWidth=2;
        const cw = canvas.width / COLS, ch = canvas.height / ROWS;
        for(let r=0;r<ROWS;r++) for(let c=0;c<COLS;c++){
          const x=c*cw, y=r*ch, cell=maze[r][c]; ctx.beginPath();
          if(cell.walls[0]) ctx.moveTo(x,y), ctx.lineTo(x+cw,y);
          if(cell.walls[1]) ctx.moveTo(x+cw,y), ctx.lineTo(x+cw,y+ch);
          if(cell.walls[2]) ctx.moveTo(x+cw,y+ch), ctx.lineTo(x,y+ch);
          if(cell.walls[3]) ctx.moveTo(x,y+ch), ctx.lineTo(x,y);
          ctx.stroke();
        }
        ctx.fillStyle='#22c55e22'; ctx.fillRect(goal.c*cw+4,goal.r*ch+4,cw-8,ch-8);
        ctx.fillStyle='#fff1'; ctx.fillRect(player.c*cw+8,player.r*ch+8,cw-16,ch-16);
        ctx.fillStyle='#ffd166'; ctx.beginPath(); ctx.arc(player.c*cw + cw/2, player.r*ch + ch/2, Math.min(cw,ch)/6,0,Math.PI*2); ctx.fill();
      }

      function canMove(toC,toR){
        if(toC<0||toC>=COLS||toR<0||toR>=ROWS) return false;
        const cur=maze[player.r][player.c]; const dc=toC-player.c, dr=toR-player.r;
        if(dr===-1 && cur.walls[0]) return false;
        if(dc===1 && cur.walls[1]) return false;
        if(dr===1 && cur.walls[2]) return false;
        if(dc===-1 && cur.walls[3]) return false;
        return true;
      }

      function movePlayer(dc,dr){
        if(!gameActive) return;
        const toC=player.c+dc, toR=player.r+dr;
        if(!canMove(toC,toR)) return;
        player.c=toC; player.r=toR; visited.add(idx(player.c,player.r)); updateUI(); draw(); checkGoal();
      }

      function manhattan(a,b){return Math.abs(a.c-b.c)+Math.abs(a.r-b.r);}

      function updateUI(){
        document.getElementById('timerDisplay').textContent = (timeLeft>0 ? timeLeft : 0)+'s';
        const curDist=manhattan(player,goal);
        const progress=Math.round(((initialDistance-curDist)/initialDistance)*100);
        document.getElementById('progressText').textContent=progress+'%';
        document.getElementById('credits').textContent=credits+' L';
      }

      function endGame(){
        gameActive=false; if(timer){clearInterval(timer); timer=null;} timeLeft=0; updateUI();
        const curDist=manhattan(player,goal);
        const progress=Math.round(((initialDistance-curDist)/initialDistance)*100);
        alert(`Juego terminado. Progreso: ${progress}%. Premio: ${getPrizeForProgress(progress)}`);
        logEntry(`Partida finalizada → Progreso: ${progress}% → Premio: ${getPrizeForProgress(progress)}`);
        // reiniciar todo para siguiente jugador
        generateMaze(currentDifficulty); initialDistance=manhattan({c:0,r:0},goal); resetPlayer(); draw();
      }

      function checkGoal(){
        if(player.c===goal.c && player.r===goal.r){
          endGame();
        }
      }

      function getPrizeForProgress(progress){
        if(progress>=100) return 'Producto sorpresa';
        if(progress>=50) return 'Jugo pequeño';
        if(progress>=30) return 'Churro';
        if(progress>=10) return 'Confite';
        return 'Sin premio';
      }

      function logEntry(text){
        const log=document.getElementById('log');
        log.innerHTML=`<div>[${new Date().toLocaleString()}] ${text}</div>`+log.innerHTML;
      }

      let currentDifficulty=0;

      document.querySelectorAll('.time-btn').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          const time=parseInt(btn.dataset.time), cost=parseInt(btn.dataset.cost);
          if(!confirm(`Desea comenzar ahora? Costo: ${cost} L, Tiempo: ${time} seg`)) return;
          if(credits<cost){ alert('No tienes crédito suficiente.'); return; }
          credits-=cost; timeLeft=time; gameActive=true;
          // establecer dificultad según costo
          currentDifficulty = cost/5; // 5L=1, 10L=2, 15L=3, 20L=4
          if(timer) clearInterval(timer);
          timer=setInterval(()=>{timeLeft--; updateUI(); if(timeLeft<=0) endGame();},1000);
          generateMaze(currentDifficulty); initialDistance=manhattan({c:0,r:0},goal); resetPlayer(); draw();
          logEntry(`Inicio partida: Tiempo ${time}s, Costo ${cost}L, Dificultad ${currentDifficulty}`);
        });
      });

      window.addEventListener('keydown',(e)=>{
        const key=e.key; if(!['ArrowUp','ArrowDown','ArrowLeft','ArrowRight'].includes(key)) return;
        e.preventDefault(); if(!gameActive) return;
        if(key==='ArrowUp') movePlayer(0,-1);
        if(key==='ArrowDown') movePlayer(0,1);
        if(key==='ArrowLeft') movePlayer(-1,0);
        if(key==='ArrowRight') movePlayer(1,0);
      });

      generateMaze(1); initialDistance=manhattan({c:0,r:0},goal); resetPlayer(); draw();

    })();
  </script>
</body>
</html>
