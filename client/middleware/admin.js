export default function ({ store, redirect, route }) {
  // If the user is not admin
  if (!store.state.auth.user.is_admin) {
    return redirect('/dashboard')
  }
}
