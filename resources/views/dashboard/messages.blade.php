@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

    body {
        background-color: #f8f9fa; 
    }
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: auto;
        scrollbar-width: none; 
        -ms-overflow-style: none;  
    }

    body::-webkit-scrollbar {
        display: none;
    }

    #messageFeed {
        overflow-y: scroll; 
        scrollbar-width: none; 
        -ms-overflow-style: none; 
    }

    #messageFeed::-webkit-scrollbar {
        display: none; 
    }

    #messageFeed p {
        color: #555;
        font-size: 0.95rem;
        font-weight: 500;
        background-color: #e5e5ea;
        padding: 12px 20px;
        border-radius: 18px;
        max-width: fit-content;
        margin: 30px auto;
        text-align: center;
        box-shadow: none;
        font-style: normal;
        user-select: none;
        opacity: 0.9;
    }

    #chatView {
        width: 75vw;
        max-width: 900px;
        margin: 2rem auto;
        height: 75vh;
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    .chat-header {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.1rem;
        padding: 10px 16px;
        background-color: #f5f6f7;
        border-bottom: 1px solid #ddd;
    }

    .chat-back-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1877f2; 
        transition: background-color 0.3s ease, color 0.3s ease;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        box-sizing: border-box;
    }

        .chat-back-btn:hover {
        background-color: rgba(24, 119, 242, 0.15);
        color: #0f61d6;
    }

    .chat-back-btn svg {
        width: 20px !important;
        height: 20px !important;
        display: block;
    }

    .chat-back-btn svg path {
        stroke: currentColor !important;
        stroke-width: 2.5; 
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .chat-user-avatar {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
        background-color: #007bff;
        border-radius: 50%;
        color: white;
        font-weight: 700;
        user-select: none;
        display: grid;
        place-items: center;
        line-height: 1;
        flex-shrink: 0;
        box-shadow: none;
    }


    .message-wrapper.incoming .avatar {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 40px;
        background-color: #999; 
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        border-radius: 50%;
        box-shadow: none;
        z-index: 10;
    }
    #chatUserName {
        font-weight: 600;
        color: #050505;
        flex-grow: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #messageFeed {
        flex-grow: 1;
        overflow-y: auto;
        padding: 1rem 1rem 1rem 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        background: #fff;
        scroll-behavior: smooth;
        overflow-x: hidden;
        padding-left: 0 !important;
        margin-left: 0 !important;
        align-items: flex-start;
    }

    .message-wrapper {
        display: flex;
        align-items: flex-end;
        word-break: break-word;
        max-width: 100%;
        gap: 0.5rem;
        position: relative;
    }

    .message-wrapper.incoming {
        align-self: flex-start;
        max-width: 70%;
        margin-left: 14px;
        gap: 0.25rem;
        padding-left: 0 !important;
    }

    .message-wrapper.incoming .message {
        margin-left: 44px;
        background: #e4e6eb;
        border-radius: 18px 18px 18px 4px;
        padding: 10px 14px;
        font-size: 1rem;
        line-height: 1.3;
        color: #050505;
        word-wrap: break-word;
        position: relative;
        z-index: 5;
        box-shadow: none;
    }

    .message-wrapper.outgoing {
        align-self: flex-end;
        justify-content: flex-end;
        gap: 0.5rem;
        margin-right: 0.5rem;
        max-width: 70%;
        position: relative;
    }

    .message-wrapper.outgoing .message {
        background: #1877f2;
        color: white;
        border-radius: 18px 18px 4px 18px;
        padding: 10px 14px;
        font-size: 1rem;
        line-height: 1.3;
        word-wrap: break-word;
        margin-left: auto;
        margin-right: 0;
        position: relative;
        z-index: 5;
        box-shadow: none;
    }

    .chat-input {
        display: flex;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-top: 1px solid #ccc;
        background: #fff;
        flex-shrink: 0;
    }

    .chat-input textarea {
        flex-grow: 1;
        resize: none;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 20px;
        max-height: 6rem;
        overflow-y: auto;
        line-height: 1.3;
        font-family: inherit;
        min-height: 2rem;
        box-shadow: inset 0 1px 3px rgb(0 0 0 / 0.1);
        transition: border-color 0.2s ease;
    }

    .chat-input textarea:focus {
        outline: none;
        border-color: #1877f2;
        box-shadow: 0 0 5px rgba(24,119,242,0.6);
    }

    .chat-input button {
        background: #1877f2;
        border: none;
        color: white;
        padding: 0 1.25rem;
        font-size: 1.2rem;
        cursor: pointer;
        border-radius: 20px;
        transition: background 0.3s ease;
        box-shadow: none;
    }

    .chat-input button:disabled {
        background: #7da6f7;
        cursor: not-allowed;
    }

    .chat-input button:hover:not(:disabled) {
        background: #155dbb;
    }

    .user-hover-item {
        background-color: transparent;
        transition: background-color 0.2s ease;
    }

    .user-hover-item:hover {
        background-color: #f0f0f0;
        cursor: pointer;
    }

    .message-timestamp {
        display: inline-block;
        margin: 1rem auto 0.5rem;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        color: #65676b;
        background-color: #f0f2f5; 
        border-radius: 12px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        user-select: none;
    }

    .user-scroll-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .user-scroll-card {
        display: block;
        width: 100%;
    }

    #sendBtn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 0 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #sendBtn:not(:disabled):hover {
        background-color: #0056b3;
    }

    #sendBtn:disabled {
        background-color: #007bff;
        color: white;
        cursor: not-allowed;
        opacity: 0.6;
    }

</style>

<div class="chat-container" role="main" aria-label="Messaging application" style="height: 100vh; display: flex; flex-direction: column;">
    <section class="chat-window" aria-live="polite" aria-atomic="false" aria-relevant="additions" style="flex-grow: 1; display: flex; flex-direction: column;">

        <div id="userListView" class="user-list p-3" role="list" aria-label="User list to select chat partner"
        style="{{ $chatWith ? 'display:none' : 'display:block' }}">

            <h1 class="mb-4 text-primary">Messages</h1>

            <div class="mb-4">
                <input type="text" id="userSearchInput" class="form-control" placeholder="Search users..." aria-label="Search users by name">
            </div>
            @foreach (['Admins' => $admins, 'Developers' => $developers, 'Employers' => $employers] as $role => $users)
            @if(count($users))
            <h5 class="mb-3">{{ $role }}</h5>
            <div class="mb-4 user-scroll-group" data-group="{{ strtolower($role) }}">
                @foreach ($users as $user)
                @php
                $avatar = strtoupper(substr($user->name, 0, 1));
                $type = get_class($user); // safer, dynamic model class
                @endphp
                <div class="user-scroll-card" data-name="{{ strtolower($user->name) }}">
                    <button type="button"
                    class="btn w-100 d-flex align-items-center gap-3 py-2 px-3 chat-user-select-btn text-start user-hover-item"
                    data-type="{{ $type }}" data-id="{{ $user->id }}"
                    aria-label="Chat with {{ $user->name }}">
                        <div class="chat-user-avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width: 42px; height: 42px; font-weight: 700; font-size: 1.1rem; user-select: none;">
                            {{ $avatar }}
                        </div>
                        <span class="fw-medium">{{ $user->name }}</span>
                    </button>
                </div>
                @endforeach
            </div>
            @endif
            @endforeach

        </div>

        <div id="chatView" role="main" aria-label="Chat interface"
        style="{{ $chatWith ? 'display:flex; flex-direction: column; height: 100%' : 'display:none' }}">
            <header class="chat-header" aria-label="Chat header" style="display: flex; align-items: center; gap: 1rem; padding: 1rem;">
                <button type="button" class="chat-back-btn" aria-label="Back to user list">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false" style="width: 24px; height: 24px;">
                      <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div class="chat-user-avatar" aria-hidden="true" id="chatUserAvatar" style="width: 42px; height: 42px; border-radius: 50%; background: #007bff; color: white; font-weight: 700; font-size: 1.1rem; display: flex; align-items: center; justify-content: center; user-select: none;">
                    A
                </div>
                <div id="chatUserName" style="font-weight: 600;">User Name</div>
            </header>

            <main id="messageFeed" tabindex="0" role="log" aria-live="polite" aria-relevant="additions" style="flex-grow: 1; overflow-y: auto; padding: 1rem;">

                <div class="message-timestamp" style="text-align: center; color: #666; font-size: 0.9rem; margin-bottom: 1rem;">August 3, 2025 at 10:42 AM</div>

                <div class="message-wrapper incoming" style="display: flex; gap: 0.5rem; margin-bottom: 1rem; align-items: flex-start;">
                    <div class="avatar" style="width: 32px; height: 32px; border-radius: 50%; background: #ccc; display: flex; align-items: center; justify-content: center;">B</div>
                    <div class="message" style="background: #e9ecef; padding: 0.5rem 1rem; border-radius: 12px; max-width: 70%;">Hello! How are you?</div>
                </div>

                <div class="message-wrapper outgoing" style="display: flex; gap: 0.5rem; margin-bottom: 1rem; justify-content: flex-end;">
                 <div class="message" style="background: #0d6efd; color: white; padding: 0.5rem 1rem; border-radius: 12px; max-width: 70%;">I'm good, thanks! What about you?</div>
                </div>

            </main>

            <form action="{{ route('messages.store') }}" method="POST" class="chat-input" id="messageForm" aria-label="Send message form" style="display: flex; gap: 0.5rem; padding: 1rem; border-top: 1px solid #ddd;">
            @csrf
                <input type="hidden" name="receiver_type" id="receiver_type" value="">
                <input type="hidden" name="receiver_id" id="receiver_id" value="">

                <textarea name="body" placeholder="Type a message..." autocomplete="off" rows="1" required aria-required="true" style="flex-grow: 1; resize: none; padding: 0.5rem; overflow: hidden;"></textarea>

                <button type="submit" id="sendBtn" aria-label="Send message" disabled>Send</button>
            </form>

        </div>
    </section>
</div>

<script>
    
    document.addEventListener('DOMContentLoaded', () => {
        const userListView = document.getElementById('userListView');
        const chatView = document.getElementById('chatView');
        const backBtn = chatView.querySelector('.chat-back-btn');
        const messageFeed = document.getElementById('messageFeed');
        const messageForm = document.getElementById('messageForm');
        const textarea = messageForm.querySelector('textarea');
        const sendBtn = messageForm.querySelector('button');
        const receiverTypeInput = document.getElementById('receiver_type');
        const receiverIdInput = document.getElementById('receiver_id');
        const chatUserName = document.getElementById('chatUserName');
        const chatUserAvatar = document.getElementById('chatUserAvatar');

        textarea.addEventListener('input', () => {
            sendBtn.disabled = textarea.value.trim().length === 0;
        });

        backBtn.addEventListener('click', () => {
            chatView.style.display = 'none';
            userListView.style.display = 'block';
            document.body.style.overflow = '';
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
            textarea.value = '';
            sendBtn.disabled = true;
            messageFeed.innerHTML = '';
            receiverTypeInput.value = '';
            receiverIdInput.value = ''; 
            localStorage.removeItem('chatContext');
        });

        function escapeHtml(text) {
            return text.replace(/[&<>"']/g, (m) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[m]));
        }

        function formatTimestamp(datetimeStr) {
            const date = new Date(datetimeStr);
            const dateStr = date.toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const timeStr = date.toLocaleTimeString(undefined, {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
            return `${dateStr} at ${timeStr}`;
        }


        const monthMap = {
            January: 0, February: 1, March: 2, April: 3,
            May: 4, June: 5, July: 6, August: 7,
            September: 8, October: 9, November: 10, December: 11
        };

        function parseDisplayedTimestamp(text) {
            text = text.trim()
            .replace(/\s+/g, ' ')
            .replace(/,?\s+at\s+/, ' at ');

            const regex = /^([A-Za-z]+) (\d{1,2}), (\d{4}) at (\d{1,2}):(\d{2}) (AM|PM)$/i;
            const match = text.match(regex);

            if (!match) {
                console.error('Timestamp parse failed for:', text);
                return new Date(NaN);
            }

            let [, monthStr, day, year, hour, minute, meridiem] = match;

            monthStr = monthStr.charAt(0).toUpperCase() + monthStr.slice(1).toLowerCase();

            const month = monthMap[monthStr];
            if (month === undefined) {
                console.error('Unknown month name:', monthStr);
                return new Date(NaN);
            }

            day = parseInt(day, 10);
            year = parseInt(year, 10);
            hour = parseInt(hour, 10);
            minute = parseInt(minute, 10);

            meridiem = meridiem.toUpperCase();

            if (meridiem === 'PM' && hour !== 12) hour += 12;
            if (meridiem === 'AM' && hour === 12) hour = 0;

            return new Date(year, month, day, hour, minute);
        }

        function shouldInsertTimestamp(currentIso, previousIso, thresholdMinutes = 5) {
            if (!previousIso) return true;
            const diffMs = new Date(currentIso) - new Date(previousIso);
            return diffMs >= thresholdMinutes * 60 * 1000;
        }

        async function loadMessages(userType, userId, userName) {
            localStorage.setItem('chatContext', JSON.stringify({
                userType,
                userId,
                userName
            }));
            chatUserName.textContent = userName.trim().slice(2);
            chatUserAvatar.textContent = userName.trim().charAt(0).toUpperCase();

            receiverTypeInput.value = userType;
            receiverIdInput.value = userId;

            userListView.style.display = 'none';
            chatView.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
            textarea.value = '';
            sendBtn.disabled = true;

            messageFeed.innerHTML = '<p style="color:#666; font-style:italic;">Loading messages...</p>';

            try {
                const url = `{{ url('/messages/fetch') }}?receiver_type=${encodeURIComponent(userType)}&receiver_id=${encodeURIComponent(userId)}`;
                const response = await fetch(url);
                if (!response.ok) throw new Error('Failed to fetch messages');
                const data = await response.json();

                if (data.messages.length === 0) {
                    messageFeed.innerHTML = '<p style="color:#666; font-style:italic;">No messages yet. Say hi!</p>';
                } else {
                    messageFeed.innerHTML = '';
                    let lastTimestampIso = null;

                    data.messages.forEach(msg => {
                        if (shouldInsertTimestamp(msg.timestamp, lastTimestampIso)) {
                            const timestampDiv = document.createElement('div');
                            timestampDiv.classList.add('message-timestamp');
                            timestampDiv.textContent = formatTimestamp(msg.timestamp);
                            messageFeed.appendChild(timestampDiv);
                            lastTimestampIso = msg.timestamp;
                        }

                        const messageWrapper = document.createElement('div');
                        messageWrapper.classList.add('message-wrapper', msg.is_sender ? 'outgoing' : 'incoming');

                        if (!msg.is_sender) {
                            const avatarDiv = document.createElement('div');
                            avatarDiv.classList.add('avatar');
                            avatarDiv.textContent = msg.sender_name.charAt(0).toUpperCase();
                            messageWrapper.appendChild(avatarDiv);
                        }

                        const messageDiv = document.createElement('div');
                        messageDiv.classList.add('message');
                        messageDiv.textContent = msg.body;
                        messageWrapper.appendChild(messageDiv);

                        messageFeed.appendChild(messageWrapper);
                    });

                    messageFeed.scrollTop = messageFeed.scrollHeight;
                }
            } catch (error) {
                messageFeed.innerHTML = `<p style="color:red;">Error loading messages.</p>`;
                console.error(error);
            }
        }

        document.querySelectorAll('.chat-user-select-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const type = btn.getAttribute('data-type');
                const id = btn.getAttribute('data-id');
                const name = btn.textContent.trim();
                loadMessages(type, id, name);
            });
        });

        messageForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (sendBtn.disabled) return;

            const formData = new FormData(messageForm);
            sendBtn.disabled = true;
            for (let [key, value] of formData.entries()) {
                console.log(key, value); 
            }

            try {
                const response = await fetch("{{ route('messages.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
                });

                if (!response.ok) throw new Error('Failed to send message');

                const data = await response.json();

                const nowIso = new Date().toISOString();

                let lastTimestampIso = null;
                const lastTimestampEl = [...messageFeed.querySelectorAll('.message-timestamp')].pop();
                if (lastTimestampEl) {
                    const parsedDate = parseDisplayedTimestamp(lastTimestampEl.textContent);
                    if (!isNaN(parsedDate.getTime())) {
                        lastTimestampIso = parsedDate.toISOString();
                    } else {
                        console.error('Invalid timestamp:', lastTimestampEl.textContent);
                    }
                }

                if (!lastTimestampEl || shouldInsertTimestamp(nowIso, lastTimestampIso)) {
                    const timestampDiv = document.createElement('div');
                    timestampDiv.classList.add('message-timestamp');
                    timestampDiv.textContent = formatTimestamp(nowIso);
                    messageFeed.appendChild(timestampDiv);
                }

                const messageWrapper = document.createElement('div');
                messageWrapper.classList.add('message-wrapper', 'outgoing');

                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message');
                messageDiv.textContent = data.body;

                messageWrapper.appendChild(messageDiv);
                messageFeed.appendChild(messageWrapper);
                messageFeed.scrollTop = messageFeed.scrollHeight;

                const noMessagesEl = messageFeed.querySelector('p');
                if (noMessagesEl && noMessagesEl.textContent.includes('No messages yet')) {
                    noMessagesEl.remove();
                }

                messageFeed.scrollTop = messageFeed.scrollHeight;

                textarea.value = '';
            } catch (error) {
                alert('Error sending message. Please try again.');
                console.error(error);
            } finally {
                sendBtn.disabled = textarea.value.trim().length === 0;
            }
        });

        document.getElementById('userSearchInput').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.user-scroll-card');
            const groups = document.querySelectorAll('.user-scroll-group');

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                card.style.display = name.includes(searchTerm) ? '' : 'none';
            });

            groups.forEach(group => {
                const visibleCards = group.querySelectorAll('.user-scroll-card:not([style*="display: none"])');
                group.previousElementSibling.style.display = visibleCards.length ? '' : 'none';
                group.style.display = visibleCards.length ? 'flex' : 'none';
            });
        });

        const chatContext = localStorage.getItem('chatContext');
        if (chatContext) {
            try {
                const { userType, userId, userName } = JSON.parse(chatContext);
                loadMessages(userType, userId, userName);
            } catch (err) {
                console.error('Failed to parse chat context:', err);
                localStorage.removeItem('chatContext');
            }
        }

        @if($chatWith)
        loadMessages("{{ get_class($chatWith) }}", "{{ $chatWith->id }}", "{{ $chatWith->name }}");
        @endif
    });
</script>

@endsection
