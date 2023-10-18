export default class User {
  constructor(attributes = {}) {
    Object.assign(this, attributes);
  }

  follows(user) {
    return !!user;
  }

  is(user) {
    return this.id === user.id;
  }

  hasPrivateProfile() {
    //
  }

  isALifer() {
    //
  }
}
