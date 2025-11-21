Auth Level System:**
- **Level 1** = Super Admin - Can edit anyone's profile, can delete personnel
- **Level 2** = Admin - Can edit anyone's profile, can delete personnel (same as 1 for personnel)
- **Level 3** = Basic/Demo (Read Only) - Can only edit their own profile, cannot delete


Auth levels apply to **both Personnel and Projects**:

**Personnel:**
- Level 1 & 2: Can edit any personnel, can delete personnel
- Level 3: Can only edit own profile, no delete

**Projects (line 474):**
- Level 3 users: Description field is read-only (`onFocus="this.blur();"` prevents editing)
- Level 1 & 2: Can edit the description field

So Level 3 is essentially "read-only/demo" mode for both:
- Can view projects but can't edit description
- Can only edit their own personnel profile

Level 1 appears to be the only one who can change OTHER users' auth levels (line 187 - shows the auth level radio buttons only if `auth_level == '1'`).
