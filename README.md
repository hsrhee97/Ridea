# RIDEA 🚗  
> **국제 학생들의 이동 편의를 위한 라이드 매칭 웹 애플리케이션**  

RIDEA는 국제 학생들이 공항이나 특정 목적지로 이동할 때 함께 이동할 사람을 찾아 비용을 절감하고 편리하게 이동할 수 있도록 돕는 **라이드 매칭 플랫폼**입니다.

📄 [RIDEA 프로젝트 포트폴리오 (PDF)](https://github.com/hsrhee97/Ridea/blob/main/document/RIDEA.pdf)

## 📌 주요 기능  

### 🏠 홈 (Home)  
- 로그인 여부에 따라 다른 홈 화면을 제공  
- 주요 기능으로 빠르게 이동할 수 있는 네비게이션 바 제공  

### 🔐 로그인 및 회원가입 (Authentication)  
- **회원가입 시 역할 선택** (운전자 / 승객)  
- **SQL 쿼리를 활용한 데이터 검증**  
- **회원가입 후 자동 로그인 적용**  

### 🚖 라이드 예약 (Ride Booking)  
- **Google Maps API**를 활용한 출발지 및 목적지 선택  
- **경로 자동 계산 기능** 제공  
- **예약 정보 입력 및 데이터베이스 저장**  

### 🔄 매칭 시스템 (Matching)  
- 날짜, 출발지, 목적지를 기준으로 **유사한 일정과 자동 매칭**  
- 예약된 라이드가 없을 경우 **향후 일정 등록 가능**  

### 💳 결제 시스템 (Payment - PayPal REST API)  
- PayPal API를 활용하여 안전한 온라인 결제 제공  
- 결제 후, 해당 일정이 TRIP 테이블에 저장되고 SURVEY 테이블에서 삭제  

### 💬 채팅 기능 (Chat)  
- 매칭된 사용자 간 **실시간 채팅 가능**  
- **POST 요청을 활용한 메시지 전송** 및 **XMLHttpRequest 기반 실시간 업데이트**  

### 📅 캘린더 기능 (Calendar)  
- 사용자가 예약된 라이드를 한눈에 확인 가능  
- 특정 일정에 대한 상세 정보를 조회할 수 있는 **모달 창 지원**  

### 📜 이용 내역 및 리뷰 (Ride History & Review)  
- 사용자가 참여한 **라이드 히스토리 확인 가능**  
- 라이드에 대한 **리뷰 작성 및 수정 기능** 제공  

### ❓ FAQ & 고객 지원 (Help & FAQ)  
- 사용자들이 자주 묻는 질문을 정리한 FAQ 페이지 제공  
- 고객 지원 요청을 데이터베이스에 저장하여 문의 관리  

## 🛠 기술 스택  

- **프론트엔드:** HTML5, CSS3, JavaScript (Vanilla JS)  
- **백엔드:** PHP  
- **데이터베이스:** MySQL, MariaDB  
- **라이브러리:** Google Maps API, PayPal REST API  
- **도구:** Git, GitHub, Visual Studio Code, Figma  

## 🔍 사용성 테스트 및 개선 사항  

- **사용성 테스트**: Interview, Think Aloud, Survey, A/B Testing을 통해 사용자 피드백 반영  
- **변경 사항**:  
  - 비밀번호 재설정 기능 추가  
  - 회원가입 후 자동 로그인 적용  
  - 예약 완료 후 팝업 알림 추가  
  - 필요 없는 비상 버튼 제거  
  - 가격 및 안전 정보 페이지 추가  

## 🏆 향후 개선 사항  

- **반응형 웹 디자인 적용**  
- **더 정밀한 매칭 알고리즘 개선**  
- **OAuth 로그인 지원 (Google, 대학 계정 등)**  
- **날짜 지난 정보 자동 업데이트 기능 추가**  

---
