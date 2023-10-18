import User from "@/Models/User";
import { Inertia } from "@inertiajs/inertia";

export function useCurrentUser() {
  return new User(Inertia.page.props.auth.user);
}
