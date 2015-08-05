<!-- Footer Scripts -->
@section('scripts.footer.components')
	<script>
		{!! file_get_contents(Laravel\Spark\Spark::resource('/js/settings/dashboard/teams.js')) !!}
	</script>
@append

<!-- Main Content -->
<spark-settings-teams-screen inline-template v-cloak>
	<!-- Create Team -->
	<div id="spark-settings-team-screen" class="panel panel-default">
		<div class="panel-heading">Create Team</div>

		<div class="panel-body">
			<spark-errors form="@{{ createTeamForm }}"></spark-errors>

			<div class="alert alert-success" v-if="createTeamForm.created">
				<strong>Great!</strong> The team was successfully created.
			</div>

			<form method="POST" class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-md-3 control-label">Name</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="name" v-model="createTeamForm.name">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<button type="submit" class="btn btn-primary" v-on="click: createTeam" v-attr="disabled: createTeamForm.creating">
							<span v-if="createTeamForm.creating">
								<i class="fa fa-btn fa-spinner fa-spin"></i>Creating
							</span>

							<span v-if=" ! createTeamForm.creating">
								<i class="fa fa-btn fa-users"></i> Create
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- Current Teams -->
	<div class="panel panel-default" v-if="teams.length > 0">
		<div class="panel-heading">Current Teams</div>

		<div class="panel-body">
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>Name</th>
						<th>Owner</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-repeat="team : teams">
						<td style="padding-top: 14px;">@{{ team.name }}</td>

						<td style="padding-top: 14px;">
							<span v-if="userOwns(team)">
								You
							</span>

							<span v-if=" ! userOwns(team)">
								@{{ team.owner.name }}
							</span>
						</td>

						<td>
							<a href="/settings/teams/@{{ team.id }}">
								<button class="btn btn-default">
									<i class="fa fa-btn fa-cog"></i>Settings
								</button>
							</a>
						</td>

						<td>
							<button class="btn btn-warning" v-on="click: leaveTeam(team)" v-if=" ! userOwns(team)">
								<i class="fa fa-btn fa-sign-out"></i>Leave
							</button>
						</td>

						<td>
							<button class="btn btn-danger" v-if="userOwns(team)">
								<i class="fa fa-btn fa-times"></i>Delete
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Pending Invitations -->
	<div class="panel panel-default" v-if="invitations.length > 0">
		<div class="panel-heading">Pending Invitations</div>

		<div class="panel-body">
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>Team</th>
						<th>Owner</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-repeat="invite : invitations">
						<td style="padding-top: 14px;">@{{ invite.team.name }}</td>

						<td style="padding-top: 14px;">
							@{{ invite.team.owner.name }}
						</td>

						<td>
							<button class="btn btn-success" v-on="click: acceptInvite(invite)">
								<i class="fa fa-btn fa-thumbs-up"></i>Accept
							</button>
						</td>

						<td>
							<button class="btn btn-danger" v-on="click: rejectInvite(invite)">
								<i class="fa fa-btn fa-thumbs-down"></i>Reject
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</spark-settings-teams-screen>