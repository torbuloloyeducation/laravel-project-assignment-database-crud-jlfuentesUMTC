<x-layout title="Edit User">
    <style>
        :root {
            --nexus-bg: #0a0c12;
            --nexus-panel: #111827;
            --nexus-border: rgba(0, 255, 200, 0.2);
            --nexus-accent: #00f2ff;
            --nexus-danger: #ef4444;
            --nexus-text: #cbd5e1;
        }

        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        body { font-family: 'Orbitron', sans-serif; }

        .nexus-body {
            background: radial-gradient(circle at 50% 50%, #0f172a 0%, var(--nexus-bg) 100%);
            min-height: 100vh;
            padding: 40px 20px;
            color: var(--nexus-text);
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .nexus-card {
            background: var(--nexus-panel);
            border: 1px solid var(--nexus-border);
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0, 255, 200, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 600px;
        }

        h1 { color: var(--nexus-accent); letter-spacing: 2px; }

        .form-input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--nexus-border);
            background: #000;
            color: var(--nexus-accent);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--nexus-accent);
            box-shadow: 0 0 10px rgba(0, 255, 200, 0.3);
        }

        .btn-primary {
            background: var(--nexus-accent);
            color: #000;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: 0.3s;
            width: 100%;
        }
        .btn-primary:hover { background: #06b6d4; box-shadow: 0 0 15px var(--nexus-accent); }

        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: var(--nexus-accent);
            font-size: 0.8rem;
            text-decoration: none;
            transition: 0.2s;
        }
        .back-link:hover { text-decoration: underline; }
    </style>

    <div class="nexus-body">
        <div class="nexus-card p-7">
            <h1 class="text-xl font-bold mb-2">Edit User</h1>
            <p class="text-xs text-indigo-300 opacity-70 mb-6">
                Updating: {{ $user->first_name }} {{ $user->last_name }}
            </p>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                {{-- Name block stacked --}}
                <input class="form-input" type="text" name="first_name" value="{{ $user->first_name }}" placeholder="First Name" required>
                <input class="form-input" type="text" name="middle_name" value="{{ $user->middle_name }}" placeholder="Middle Name">
                <input class="form-input" type="text" name="last_name" value="{{ $user->last_name }}" placeholder="Last Name" required>
                <input class="form-input" type="text" name="nickname" value="{{ $user->nickname }}" placeholder="Nickname">

                {{-- Contact block --}}
                <input class="form-input" type="email" name="email" value="{{ $user->email }}" placeholder="Email" required>
                <input class="form-input" type="number" name="age" value="{{ $user->age }}" placeholder="Age" min="1">
                <input class="form-input" type="text" name="contact_number" value="{{ $user->contact_number }}" placeholder="Contact Number">

                {{-- Address block --}}
                <textarea class="form-input" name="address" rows="3" placeholder="Address">{{ $user->address }}</textarea>

                <button class="btn-primary" type="submit">Update User</button>
            </form>

            <a href="{{ route('users.index') }}" class="back-link">← Back to Dashboard</a>
        </div>
    </div>
</x-layout>