<?php
echo $this->Html->script('socket.js');
echo $this->Html->css('checkers.css');

?>
<input type="hidden" id="lobby-id" value="<?= $lobby->id ?>">
<input type="hidden" id="player1-id" value="<?= $lobby->player1_user_id ?>">
<input type="hidden" id="player2-id" value="<?= $lobby->player2_user_id ?>">

<div class="col-xs-12 top-container no-padding">
	<div class="col-xs-4 fill placeholder no-padding">
<!--		Player 1 Block-->
		<div class="top-side-division">
			<div class="division-header">
				<span id="player1-name">
		  <?php if (isset($lobby->player1))
		  echo $lobby->player1->username; ?>
				</span>
			</div>
			<div class="stats fill">
				<div class="wrapper">
					<div id="player1">
						<h3>Player 1</h3>
					</div>
				</div>
				<div class="turn" id="player1Turn"></div>
			</div>

		</div>
<!--		Player 2 Block-->
		<div class="bottom-side-division">
			<div class="division-header">
		  	<span id="player2-name">
		  <?php if (isset($lobby->player2))
		  echo $lobby->player2->username;
	  else
		  echo "Waiting for player to join..." ?>
				</span>
			</div>
			<div class="stats fill">
				<div class="wrapper">
					<div id="player2">
						<h3>Player 2</h3>
					</div>
				</div>
				<div class="turn" id="player2Turn"></div>
			</div>
		</div>
	</div>

	<div class="col-xs-8 fill">
		<div class="home-container">
			<div class="welcome-header">
				<h1><?= h($lobby->name) ?></h1>
			</div>
			<p>
		  <?php if (isset($is_player1)): ?>
						You are the Host (Player 1) of this Lobby
		  <?php elseif (isset($is_player2)): ?>
						You are Player 2 in this Lobby
		  <?php else: ?>
						You are just spectating this Lobby
		  <?php endif; ?>
		  <?php if (isset($is_player1) || isset($is_player2)): ?>
			<form method="post" accept-charset="utf-8" action="/lobbies/start/<?= $lobby->id ?>">
				<button id="start-lobby-btn" class="btn btn-primary"
			<?php if ($lobby->lobby_status_id != \App\Model\Entity\LobbyStatus::Full) : ?>
							disabled
			<?php endif; ?>
								type="submit">Start Game
				</button>
			</form>
		<?php endif; ?>

		<?php if (isset($is_player1) || isset($is_player2)): ?>
					<form method="post" accept-charset="utf-8" action="/lobbies/leave/<?= $lobby->id ?>">
						<button id="leave-lobby-btn" class="btn btn-primary" type="submit">Leave Lobby
						</button>
					</form>
		<?php endif; ?>
			</p>
		</div>
	</div>
</div>
<div class="col-xs-12 bottom-container no-padding ">
	<?= $this->element('chat', array('messages' => $messages, 'chat_id' => $lobby->chat_id, $username, $user_id)) ?>
</div>
